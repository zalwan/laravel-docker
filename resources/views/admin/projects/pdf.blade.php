<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Projects</title>
    <style>
        body {
            color: #111827;
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.45;
        }

        h1 {
            font-size: 22px;
            margin: 0 0 6px;
        }

        .muted {
            color: #6b7280;
        }

        .header {
            border-bottom: 2px solid #0f766e;
            margin-bottom: 18px;
            padding-bottom: 12px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #d1d5db;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #f3f4f6;
            font-weight: bold;
        }

        .status {
            border-radius: 10px;
            display: inline-block;
            font-size: 11px;
            font-weight: bold;
            padding: 3px 8px;
        }

        .status-finished {
            background: #dcfce7;
            color: #166534;
        }

        .status-planned {
            background: #e5e7eb;
            color: #374151;
        }

        .status-progress {
            background: #fef3c7;
            color: #92400e;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Data Projects</h1>
        <div class="muted">Dicetak pada {{ now()->format('d M Y H:i') }}</div>
        <div class="muted">Total project: {{ $projects->count() }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 4%;">No</th>
                <th style="width: 24%;">Project</th>
                <th style="width: 34%;">Deskripsi</th>
                <th style="width: 24%;">Teknologi</th>
                <th style="width: 14%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->description ?: '-' }}</td>
                    <td>
                        @forelse ($project->teknologi ?? [] as $tech)
                            {{ $tech }}@if (! $loop->last), @endif
                        @empty
                            -
                        @endforelse
                    </td>
                    <td>
                        <span
                            class="status
                            @if (strtolower($project->status) === 'selesai') status-finished
                            @elseif (strtolower($project->status) === 'planned') status-planned
                            @else status-progress @endif"
                        >
                            {{ ucfirst($project->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Belum ada project.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
