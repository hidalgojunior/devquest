<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\GitCommit;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class SubmissionController extends Controller
{
    public function show($id)
    {
        $submission = Submission::findOrFail($id);
        $commits = $submission->commits;
        if ($commits->isEmpty() && $submission->github_link) {
            // attempt fetch
            try {
                $url = $submission->github_link;
                // simple parse for repo path and maybe commit
                // assume link of form https://github.com/user/repo/commit/<hash> or /tree/<branch>
                if (preg_match("#github\.com/([^/]+/[^/]+)#", $url, $m)) {
                    $repo = $m[1];
                    $apiUrl = "https://api.github.com/repos/$repo/commits";
                    $res = Http::withHeaders(['Accept'=>'application/vnd.github.v3+json'])
                                ->get($apiUrl);
                    if ($res->ok()) {
                        foreach($res->json() as $c) {
                            GitCommit::create([
                                'submission_id' => $submission->id,
                                'commit_hash' => $c['sha'],
                                'message' => $c['commit']['message'],
                                'committed_at' => Carbon::parse($c['commit']['committer']['date']),
                                'url' => $c['html_url'],
                            ]);
                        }
                        $commits = $submission->commits()->get();
                    }
                }
            } catch (\Exception $e) {
                // ignore
            }
        }
        return view('submissions.show', compact('submission','commits'));
    }
}
