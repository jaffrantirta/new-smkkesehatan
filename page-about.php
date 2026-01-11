<?php
/**
 * Template Name: About Us Page
 * Description: About us page with hero, description, and vision mission
 */

get_header();

// Get About Hero Section Settings
$about_hero_image = get_theme_mod('smk_about_hero_image', get_template_directory_uri() . '/assets/images/hero-default.jpg');
$about_hero_title = get_theme_mod('smk_about_hero_title', 'Tentang Kami');
$about_hero_text = get_theme_mod('smk_about_hero_text', 'Mengenal lebih dekat SMK Kesehatan Bali Dewata');

// Get About Content
$about_title = get_theme_mod('smk_about_title', 'Sejarah dan Profil Sekolah');
$about_text = get_theme_mod('smk_about_text', 'SMK Kesehatan Bali Dewata didirikan dengan visi untuk mencetak tenaga kesehatan profesional yang kompeten dan berakhlak mulia. Dengan pengalaman lebih dari 10 tahun dalam pendidikan vokasi kesehatan, kami telah menghasilkan ribuan lulusan yang tersebar di berbagai fasilitas kesehatan di seluruh Indonesia.<br><br>Kami berkomitmen untuk memberikan pendidikan berkualitas tinggi melalui kurikulum yang disesuaikan dengan kebutuhan industri, didukung oleh tenaga pengajar berpengalaman dan fasilitas praktik yang modern. Setiap siswa dibimbing untuk tidak hanya menguasai kompetensi teknis, tetapi juga mengembangkan karakter profesional dan etika kerja yang kuat.');
$about_image = get_theme_mod('smk_about_image', 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80');

// Get Vision Mission
$vision_title = get_theme_mod('smk_vision_title', 'Visi');
$vision_text = get_theme_mod('smk_vision_text', 'Menjadi lembaga pendidikan vokasi kesehatan terkemuka yang menghasilkan tenaga kesehatan profesional, kompeten, dan berakhlak mulia untuk memajukan dunia kesehatan Indonesia.');

$mission_title = get_theme_mod('smk_mission_title', 'Misi');
$mission_items = get_theme_mod('smk_mission_items', "Menyelenggarakan pendidikan vokasi kesehatan berkualitas tinggi dengan kurikulum berbasis industri\nMengembangkan kompetensi siswa melalui pembelajaran teori dan praktik yang seimbang\nMembentuk karakter profesional dan etika kerja yang kuat pada setiap siswa\nMenjalin kerja sama dengan institusi kesehatan untuk program magang dan penempatan kerja\nMeningkatkan kualitas tenaga pengajar dan fasilitas pembelajaran secara berkelanjutan");
?>

<!-- About Hero Section -->
<section class="about-hero-section">
    <div class="about-hero-container">
        <img src="<?php echo esc_url($about_hero_image); ?>" class="about-hero-image" alt="<?php echo esc_attr($about_hero_title); ?>">
        <div class="about-hero-overlay"></div>
        <div class="about-hero-content">
            <div class="container">
                <div class="about-hero-text-wrapper">
                    <h1 class="about-hero-title"><?php echo esc_html($about_hero_title); ?></h1>
                    <p class="about-hero-text"><?php echo esc_html($about_hero_text); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Content Section -->
<section class="about-content-section section-pad">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="about-content">
                    <h2 class="about-content-title"><?php echo esc_html($about_title); ?></h2>
                    <div class="about-content-text">
                        <?php echo wp_kses_post(wpautop($about_text)); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-image">
                    <img src="<?php echo esc_url($about_image); ?>" alt="<?php echo esc_attr($about_title); ?>">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision Mission Section -->
<section class="vision-mission-section section-pad" style="background: linear-gradient(180deg, #f8f9fc 0%, #ffffff 100%);">
    <div class="container">
        <div class="row g-5">
            <!-- Vision -->
            <div class="col-lg-6">
                <div class="vm-card vision-card">
                    <div class="vm-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                        </svg>
                    </div>
                    <h2 class="vm-title"><?php echo esc_html($vision_title); ?></h2>
                    <div class="vm-content">
                        <?php echo wp_kses_post(wpautop($vision_text)); ?>
                    </div>
                </div>
            </div>

            <!-- Mission -->
            <div class="col-lg-6">
                <div class="vm-card mission-card">
                    <div class="vm-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                        </svg>
                    </div>
                    <h2 class="vm-title"><?php echo esc_html($mission_title); ?></h2>
                    <div class="vm-content">
                        <ul class="mission-list">
                            <?php
                            $mission_array = explode("\n", $mission_items);
                            foreach ($mission_array as $mission) {
                                $mission = trim($mission);
                                if (!empty($mission)) {
                                    echo '<li>' . esc_html($mission) . '</li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Team Section -->
<?php
$team_title = get_theme_mod('smk_team_title', 'Our Team');
$team_description = get_theme_mod('smk_team_description', 'Meet our dedicated team of professionals committed to providing quality education.');
$team_image = get_theme_mod('smk_team_image', '');
$team_count = absint(get_theme_mod('smk_team_count', 4));
if ($team_count < 1) $team_count = 1;
if ($team_count > 8) $team_count = 8;
?>
<section class="team-section section-pad">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title"><?php echo esc_html($team_title); ?></h2>
            <p class="section-description"><?php echo esc_html($team_description); ?></p>
        </div>

        <div class="row g-5 align-items-center">
            <!-- Team Image -->
            <div class="col-lg-5">
                <div class="team-image-wrapper">
                    <?php if ($team_image): ?>
                        <img src="<?php echo esc_url($team_image); ?>" alt="<?php echo esc_attr($team_title); ?>" class="team-image">
                    <?php else: ?>
                        <div class="team-image-placeholder">
                            <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                            </svg>
                            <p>Team Photo</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Team Members List -->
            <div class="col-lg-7">
                <div class="team-members-grid">
                    <?php for ($i = 1; $i <= $team_count; $i++):
                        $team_name = get_theme_mod("smk_team_name_{$i}", "Team Member {$i}");
                        $team_title_text = get_theme_mod("smk_team_title_{$i}", 'Position');
                        $team_desc = get_theme_mod("smk_team_description_{$i}", 'Description of team member role and responsibilities.');
                    ?>
                        <div class="team-member-card">
                            <div class="team-member-header">
                                <div class="team-member-avatar">
                                    <span><?php echo esc_html(substr($team_name, 0, 1)); ?></span>
                                </div>
                                <div class="team-member-info">
                                    <h3 class="team-member-name"><?php echo esc_html($team_name); ?></h3>
                                    <p class="team-member-title"><?php echo esc_html($team_title_text); ?></p>
                                </div>
                            </div>
                            <p class="team-member-description"><?php echo esc_html($team_desc); ?></p>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe elements
    const aboutContent = document.querySelector('.about-content');
    const aboutImage = document.querySelector('.about-image');
    const vmCards = document.querySelectorAll('.vm-card');
    const teamImageWrapper = document.querySelector('.team-image-wrapper');
    const teamMemberCards = document.querySelectorAll('.team-member-card');
    const teamSectionHeader = document.querySelector('.team-section .section-header');

    if (aboutContent) observer.observe(aboutContent);
    if (aboutImage) observer.observe(aboutImage);
    vmCards.forEach(card => observer.observe(card));
    if (teamImageWrapper) observer.observe(teamImageWrapper);
    teamMemberCards.forEach(card => observer.observe(card));
    if (teamSectionHeader) observer.observe(teamSectionHeader);
});
</script>

<?php
get_footer();
