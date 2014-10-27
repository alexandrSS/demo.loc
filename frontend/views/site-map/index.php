<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($items as $item): ?>
        <?php foreach ($item['models'] as $model): ?>
            <url>
                <loc><?php echo $host; ?><?php echo $model->getUrl(); ?></loc>
                <lastmod><?php echo date("Y-m-d", strtotime($model->updated)); ?></lastmod>
                <changefreq><?php echo $item['changefreq']; ?></changefreq>
                <priority><?php echo $item['priority']; ?></priority>
            </url>
        <?php endforeach; ?>
    <?php endforeach; ?>
</urlset>