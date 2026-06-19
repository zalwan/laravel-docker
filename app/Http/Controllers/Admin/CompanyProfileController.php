<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyProfileController extends Controller
{
    public function index(): View
    {
        $contents = CompanyContent::query()
            ->orderBy('section')
            ->orderBy('sort_order')
            ->paginate(15);

        return view('admin.profile.index', compact('contents'));
    }

    public function create(): View
    {
        return view('admin.profile.create', [
            'content' => new CompanyContent(),
            'sections' => $this->sections(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        CompanyContent::create($this->validatedData($request));

        return redirect()
            ->route('admin.profile.index')
            ->with('status', 'Company profile content berhasil dibuat.');
    }

    public function edit(CompanyContent $profile): View
    {
        return view('admin.profile.edit', [
            'content' => $profile,
            'sections' => $this->sections(),
        ]);
    }

    public function update(Request $request, CompanyContent $profile): RedirectResponse
    {
        $profile->update($this->validatedData($request));

        return redirect()
            ->route('admin.profile.index')
            ->with('status', 'Company profile content berhasil diperbarui.');
    }

    public function destroy(CompanyContent $profile): RedirectResponse
    {
        $profile->delete();

        return redirect()
            ->route('admin.profile.index')
            ->with('status', 'Company profile content berhasil dihapus.');
    }

    /**
     * @return array<int, string>
     */
    private function sections(): array
    {
        return [
            'stat',
            'highlight',
            'identity',
            'mission',
            'client',
            'service',
            'advantage',
            'contact',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'section' => ['required', 'string', 'max:100'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'value' => ['nullable', 'string', 'max:255'],
            'label' => ['nullable', 'string', 'max:255'],
            'items' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:65535'],
        ]);

        $data['items'] = collect(preg_split('/\r\n|\r|\n/', (string) ($data['items'] ?? '')))
            ->map(fn (string $item): string => trim($item))
            ->filter()
            ->values()
            ->all();

        if ($data['items'] === []) {
            $data['items'] = null;
        }

        return $data;
    }
}
