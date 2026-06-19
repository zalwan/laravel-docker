<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>BAWANA Project Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #111827;
            font-size: 12px;
            line-height: 1.5;
        }

        h1,
        h2 {
            margin: 0;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 4px;
        }

        h2 {
            font-size: 15px;
            margin: 24px 0 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
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

        .muted {
            color: #6b7280;
        }

        .grid {
            width: 100%;
            margin-top: 18px;
        }

        .grid td {
            width: 25%;
            background: #f9fafb;
        }

        .metric {
            display: block;
            font-size: 22px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>BAWANA Project Report</h1>
    <div class="muted">Generated at {{ $generatedAt->format('d M Y H:i') }}</div>

    <table class="grid">
        <tr>
            <td><span class="metric">{{ $summary['company_contents'] }}</span>Company Contents</td>
            <td><span class="metric">{{ $summary['articles'] }}</span>Articles</td>
            <td><span class="metric">{{ $summary['products'] }}</span>Products</td>
            <td><span class="metric">{{ $summary['gallery_items'] }}</span>Gallery Items</td>
        </tr>
    </table>

    <h2>Publishing Summary</h2>
    <table>
        <tbody>
            <tr>
                <th>Published Articles</th>
                <td>{{ $summary['published_articles'] }}</td>
                <th>Active Products</th>
                <td>{{ $summary['active_products'] }}</td>
            </tr>
            <tr>
                <th>Published Gallery Items</th>
                <td>{{ $summary['published_gallery_items'] }}</td>
                <th>Total Managed Records</th>
                <td>{{ $summary['company_contents'] + $summary['articles'] + $summary['products'] + $summary['gallery_items'] }}</td>
            </tr>
        </tbody>
    </table>

    <h2>Latest Articles</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Published At</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($latestArticles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ ucfirst($article->status) }}</td>
                    <td>{{ $article->published_at?->format('d M Y H:i') ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="3">No articles.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h2>Latest Products</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Featured</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($latestProducts as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ ucfirst($product->status) }}</td>
                    <td>{{ $product->is_featured ? 'Yes' : 'No' }}</td>
                </tr>
            @empty
                <tr><td colspan="3">No products.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h2>Latest Gallery Items</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Published</th>
                <th>Image Path</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($latestGalleryItems as $galleryItem)
                <tr>
                    <td>{{ $galleryItem->title }}</td>
                    <td>{{ $galleryItem->is_published ? 'Yes' : 'No' }}</td>
                    <td>{{ $galleryItem->image_path }}</td>
                </tr>
            @empty
                <tr><td colspan="3">No gallery items.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
