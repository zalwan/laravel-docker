<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::latest()->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        return view('admin.projects.create', [
            'project' => new Project([
                'status' => 'planned',
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Project::create($this->validatedData($request));

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project berhasil ditambahkan.');
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $project->update($this->validatedData($request));

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project berhasil dihapus.');
    }

    /**
     * @return array{title: string, description: ?string, teknologi: array<int, string>, image: ?string, status: string}
     */
    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'teknologi' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:planned,on progress,selesai'],
        ]);

        $data['teknologi'] = collect(explode(',', $data['teknologi'] ?? ''))
            ->map(fn (string $technology): string => trim($technology))
            ->filter()
            ->values()
            ->all();

        $data['description'] = $data['description'] ?? null;
        $data['image'] = $data['image'] ?? null;

        return $data;
    }
}
