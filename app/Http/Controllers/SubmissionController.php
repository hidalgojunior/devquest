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
                $user = $submission->user;
                $repoPath = null;

                if (preg_match("#github\.com/([^/]+/[^/]+)#", $url, $m)) {
                    $repoPath = $m[1];
                } elseif ($user?->github_username) {
                    $repoName = $user->github_repository ?: $user->github_username;
                    $repoPath = $user->github_username.'/'.$repoName;
                }

                if ($repoPath) {
                    $apiUrl = "https://api.github.com/repos/$repoPath/commits";
                    $folder = trim((string) $submission->activity?->title);

                    $res = Http::withHeaders(['Accept'=>'application/vnd.github.v3+json'])
                                ->get($apiUrl, ['path' => $folder]);

                    if (!$res->ok()) {
                        $res = Http::withHeaders(['Accept'=>'application/vnd.github.v3+json'])
                            ->get($apiUrl);
                    }

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
