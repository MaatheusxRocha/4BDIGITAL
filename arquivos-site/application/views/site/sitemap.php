<?= '<?xml version="1.0" encoding="UTF-8" ?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= site_url(); ?></loc> 
        <priority>1.0</priority>
        <changefreq>monthly</changefreq>
    </url>
<? foreach ($urls_static as $url) { ?>
    <url>
        <loc><?= $url ?></loc>
        <priority>0.80</priority>
    </url>
<? } ?>
<? foreach ($urls_dinamic as $url) { ?>
    <url>
        <loc><?= $url ?></loc>
        <priority>0.70</priority>
    </url>
<? } ?>

</urlset>