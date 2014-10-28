<?= '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($tests as $test): ?>
        <url>
            <loc><?= 'http://sdfgh'; ?><?= $test['url']; ?></loc>
            <lastmod><?= $test['date']; ?></lastmod>
            <changefreq><?= $test['changefreq']; ?></changefreq>
            <priority><?= $test['priority']; ?></priority>
        </url>
    <?php endforeach; ?>
</urlset>