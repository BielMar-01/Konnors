<?php /* Template Name:  MZ - Events */ ?>
<?php
    get_header();
    get_template_part('partials/content', 'top');
?>

<div class="wpContent--events my-5">
    <div class="container">
        <?php
            locate_template('partials/calendar-events.php', true, true);
            locate_template('partials/calendar-upcoming-events.php', true, true);
            locate_template('partials/calendar-past-events.php', true, true);
        ?>
    </div>
</div>

<?php
    get_template_part('partials/content', 'bottom');
    get_footer();
?>