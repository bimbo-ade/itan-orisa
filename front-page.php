<?php
get_header();
?>

<?php
$home_page = get_page_by_path('home');
if ($home_page) :
    $content = apply_filters('the_content', $home_page->post_content);
    echo $content;
else :
?>
    <div style="text-align: center; padding: 50px; background: #1A1A1A; border-radius: 8px;">
        <h2>Create Your Home Page</h2>
        <p>Go to WordPress admin → Pages → Add New</p>
        <p>Title: <strong>Home</strong></p>
        <p>Then add your content using the Custom HTML block.</p>
    </div>
<?php
endif;
?>

<?php
get_footer();