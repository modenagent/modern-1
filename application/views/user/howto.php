
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// How-to tutorials data (this would typically come from a database)
$tutorials = array(
    array(
        'id' => 'getting-started',
        'title' => 'Getting Started with Modern Agent',
        'description' => 'Learn the basics of creating your first real estate flyer with our step-by-step guide.',
        'image' => 'assets/images/tutorials/getting-started.jpg',
        'date' => 'Nov 15, 2024',
        'duration' => '3 minutes',
        'difficulty' => 'Beginner',
        'video_url' => '#',
        'content' => 'A comprehensive introduction to using Modern Agent for creating professional real estate marketing materials.'
    ),
    array(
        'id' => 'advanced-design',
        'title' => 'Advanced Design Techniques',
        'description' => 'Master advanced customization options to create stunning, professional-looking flyers that stand out.',
        'image' => 'assets/images/tutorials/advanced-design.jpg',
        'date' => 'Nov 10, 2024',
        'duration' => '8 minutes',
        'difficulty' => 'Advanced',
        'video_url' => '#',
        'content' => 'Deep dive into advanced features including custom layouts, typography choices, and color schemes.'
    ),
    array(
        'id' => 'printing-tips',
        'title' => 'Professional Printing Guide',
        'description' => 'Everything you need to know about preparing your flyers for high-quality printing and distribution.',
        'image' => 'assets/images/tutorials/printing-tips.jpg',
        'date' => 'Nov 5, 2024',
        'duration' => '5 minutes',
        'difficulty' => 'Intermediate',
        'video_url' => '#',
        'content' => 'Best practices for print-ready files, paper selection, and distribution strategies.'
    ),
    array(
        'id' => 'team-collaboration',
        'title' => 'Team Collaboration Features',
        'description' => 'Learn how to collaborate with team members and share flyer templates across your real estate office.',
        'image' => 'assets/images/tutorials/team-collaboration.jpg',
        'date' => 'Oct 28, 2024',
        'duration' => '6 minutes',
        'difficulty' => 'Intermediate',
        'video_url' => '#',
        'content' => 'Maximize productivity with team features, shared templates, and workflow management.'
    ),
    array(
        'id' => 'mobile-optimization',
        'title' => 'Mobile-Optimized Marketing',
        'description' => 'Create marketing materials that look great on all devices and learn mobile-first design principles.',
        'image' => 'assets/images/tutorials/mobile-optimization.jpg',
        'date' => 'Oct 20, 2024',
        'duration' => '4 minutes',
        'difficulty' => 'Beginner',
        'video_url' => '#',
        'content' => 'Ensure your marketing materials are effective across desktop, tablet, and mobile platforms.'
    ),
    array(
        'id' => 'analytics-tracking',
        'title' => 'Analytics and Performance Tracking',
        'description' => 'Track the performance of your marketing campaigns and optimize for better results.',
        'image' => 'assets/images/tutorials/analytics.jpg',
        'date' => 'Oct 15, 2024',
        'duration' => '7 minutes',
        'difficulty' => 'Advanced',
        'video_url' => '#',
        'content' => 'Use data-driven insights to improve your marketing effectiveness and ROI.'
    )
);

// Template data for base template
$template_data = array(
    'title' => 'How-To Guides & Tutorials',
    'meta_description' => 'Learn how to create professional real estate flyers with our comprehensive video tutorials and step-by-step guides.',
    'meta_keywords' => 'how-to, tutorials, real estate flyers, guides, video tutorials, Modern Agent',
    'additional_css' => array(),
    'additional_js' => array()
);

// Capture the how-to content
ob_start();
?>

<section class="content" id="how-to">
    <div class="container">
        <header class="page-header">
            <h1 class="page-header">How-To Guides & Tutorials</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vulputate nisl eu odio porttitor, ac pulvinar nunc congue.</p>
        </header>
        <div class="row">
            <?php foreach ($tutorials as $tutorial): ?>
                <div class="col-md-4">
                    <article class="blog-wrap">
                        <img src="<?php echo base_url($tutorial['image']); ?>" 
                             alt="<?php echo htmlspecialchars($tutorial['title'], ENT_QUOTES, 'UTF-8'); ?>" 
                             class="img-responsive">
                        <div class="blog-content">
                            <time class="meta" datetime="<?php echo date('Y-m-d', strtotime($tutorial['date'])); ?>">
                                <?php echo date('M d, Y', strtotime($tutorial['date'])); ?>
                            </time>
                            <h3>
                                <a href="<?php echo htmlspecialchars($tutorial['video_url'], ENT_QUOTES, 'UTF-8'); ?>" 
                                   aria-label="Watch tutorial: <?php echo htmlspecialchars($tutorial['title'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php echo htmlspecialchars($tutorial['title'], ENT_QUOTES, 'UTF-8'); ?>
                                </a>
                            </h3>
                            <p><?php echo htmlspecialchars($tutorial['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <p>
                                <span class="badge badge-info"><?php echo htmlspecialchars($tutorial['duration'], ENT_QUOTES, 'UTF-8'); ?></span>
                                <span class="badge badge-secondary"><?php echo htmlspecialchars($tutorial['difficulty'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </p>
                            <a class="rmore" 
                               href="<?php echo htmlspecialchars($tutorial['video_url'], ENT_QUOTES, 'UTF-8'); ?>" 
                               aria-label="Read more about <?php echo htmlspecialchars($tutorial['title'], ENT_QUOTES, 'UTF-8'); ?>">
                                <i class="fa fa-play" aria-hidden="true"></i> Watch Now
                            </a>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
$template_data['content'] = ob_get_clean();
$this->load->view('templates/base', $template_data);
?>
        </div>
    </div>
</header>

<!-- Main Content -->
<main class="main-content" role="main">
    <div class="container">
        <!-- Filter and Search Section -->
        <section class="tutorial-filters" aria-label="Tutorial filters">
            <div class="filter-controls">
                <div class="search-box">
                    <label for="tutorial-search" class="sr-only">Search tutorials</label>
                    <input type="search" 
                           id="tutorial-search" 
                           class="form-input" 
                           placeholder="Search tutorials..."
                           aria-describedby="search-help">
                    <span id="search-help" class="sr-only">Search through our tutorial library</span>
                </div>
                
                <div class="filter-buttons">
                    <button type="button" class="filter-btn active" data-filter="all" aria-pressed="true">
                        All Tutorials
                    </button>
                    <button type="button" class="filter-btn" data-filter="beginner" aria-pressed="false">
                        Beginner
                    </button>
                    <button type="button" class="filter-btn" data-filter="intermediate" aria-pressed="false">
                        Intermediate
                    </button>
                    <button type="button" class="filter-btn" data-filter="advanced" aria-pressed="false">
                        Advanced
                    </button>
                </div>
            </div>
        </section>

        <!-- Tutorials Grid -->
        <section class="tutorials-section" aria-labelledby="tutorials-heading">
            <h2 id="tutorials-heading" class="sr-only">Available Tutorials</h2>
            
            <div class="tutorials-grid">
                <?php foreach ($tutorials as $tutorial): ?>
                <article class="tutorial-card" 
                         data-difficulty="<?php echo strtolower($tutorial['difficulty']); ?>"
                         data-title="<?php echo strtolower($tutorial['title']); ?>"
                         data-description="<?php echo strtolower($tutorial['description']); ?>">
                    
                    <!-- Tutorial Image -->
                    <div class="tutorial-image">
                        <img src="<?php echo base_url($tutorial['image']); ?>" 
                             alt="<?php echo htmlspecialchars($tutorial['title'], ENT_QUOTES, 'UTF-8'); ?> tutorial preview"
                             class="tutorial-img"
                             data-src="<?php echo base_url($tutorial['image']); ?>"
                             loading="lazy">
                        
                        <!-- Play Button Overlay -->
                        <div class="play-overlay">
                            <button type="button" 
                                    class="play-btn"
                                    aria-label="Play <?php echo htmlspecialchars($tutorial['title'], ENT_QUOTES, 'UTF-8'); ?> tutorial">
                                <i class="fa fa-play" aria-hidden="true"></i>
                            </button>
                        </div>
                        
                        <!-- Tutorial Metadata -->
                        <div class="tutorial-meta">
                            <span class="difficulty-badge difficulty-<?php echo strtolower($tutorial['difficulty']); ?>">
                                <?php echo htmlspecialchars($tutorial['difficulty'], ENT_QUOTES, 'UTF-8'); ?>
                            </span>
                            <span class="duration-badge">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                <?php echo htmlspecialchars($tutorial['duration'], ENT_QUOTES, 'UTF-8'); ?>
                            </span>
                        </div>
                    </div>
                    
                    <!-- Tutorial Content -->
                    <div class="tutorial-content">
                        <header class="tutorial-header">
                            <time class="tutorial-date" datetime="<?php echo date('Y-m-d', strtotime($tutorial['date'])); ?>">
                                <?php echo htmlspecialchars($tutorial['date'], ENT_QUOTES, 'UTF-8'); ?>
                            </time>
                            
                            <h3 class="tutorial-title">
                                <a href="<?php echo htmlspecialchars($tutorial['video_url'], ENT_QUOTES, 'UTF-8'); ?>" 
                                   class="tutorial-link"
                                   data-tutorial-id="<?php echo htmlspecialchars($tutorial['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php echo htmlspecialchars($tutorial['title'], ENT_QUOTES, 'UTF-8'); ?>
                                </a>
                            </h3>
                        </header>
                        
                        <p class="tutorial-description">
                            <?php echo htmlspecialchars($tutorial['description'], ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                        
                        <footer class="tutorial-footer">
                            <a href="<?php echo htmlspecialchars($tutorial['video_url'], ENT_QUOTES, 'UTF-8'); ?>" 
                               class="tutorial-cta"
                               data-tutorial-id="<?php echo htmlspecialchars($tutorial['id'], ENT_QUOTES, 'UTF-8'); ?>"
                               aria-label="Watch <?php echo htmlspecialchars($tutorial['title'], ENT_QUOTES, 'UTF-8'); ?> tutorial">
                                <i class="fa fa-play-circle" aria-hidden="true"></i>
                                Watch Tutorial
                            </a>
                        </footer>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
            
            <!-- Empty State -->
            <div class="empty-state" id="no-results" style="display: none;">
                <div class="empty-state-icon">
                    <i class="fa fa-search fa-4x text-muted" aria-hidden="true"></i>
                </div>
                <h3 class="empty-state-title">No Tutorials Found</h3>
                <p class="empty-state-text">Try adjusting your search or filter criteria to find the tutorials you're looking for.</p>
                <button type="button" class="btn btn-primary" onclick="clearFilters()">
                    Clear Filters
                </button>
            </div>
        </section>

        <!-- Getting Started CTA -->
        <section class="cta-section" aria-labelledby="cta-heading">
            <div class="cta-content">
                <h2 id="cta-heading" class="cta-title">Ready to Get Started?</h2>
                <p class="cta-description">Join thousands of real estate professionals who trust Modern Agent for their marketing needs.</p>
                <div class="cta-actions">
                    <a href="<?php echo site_url('register'); ?>" class="btn btn-primary btn-lg">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                        Create Free Account
                    </a>
                    <a href="<?php echo site_url('contact'); ?>" class="btn btn-secondary btn-lg">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        Contact Support
                    </a>
                </div>
            </div>
        </section>
    </div>
</main>

<!-- Tutorial Modal -->
<div class="modal" id="tutorial-modal" aria-hidden="true" role="dialog" aria-labelledby="tutorial-modal-title">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <header class="modal-header">
                <h2 class="modal-title" id="tutorial-modal-title">Tutorial</h2>
                <button type="button" 
                        class="close" 
                        data-modal-close
                        aria-label="Close tutorial">
                    <span aria-hidden="true">&times;</span>
                </button>
            </header>
            
            <div class="modal-body" id="tutorial-modal-content">
                <!-- Tutorial video/content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<?php
$template_data['content'] = ob_get_clean();

// Add inline JavaScript for tutorial functionality
$template_data['inline_js'] = '
// Tutorial page functionality
(function() {
    "use strict";
    
    const TutorialManager = {
        init: function() {
            this.bindEvents();
            this.initializeFilters();
            this.setupSearch();
        },
        
        bindEvents: function() {
            // Filter buttons
            document.addEventListener("click", function(e) {
                if (e.target.closest(".filter-btn")) {
                    e.preventDefault();
                    const button = e.target.closest(".filter-btn");
                    TutorialManager.handleFilter(button);
                }
            });
            
            // Tutorial links
            document.addEventListener("click", function(e) {
                if (e.target.closest(".tutorial-link, .tutorial-cta, .play-btn")) {
                    e.preventDefault();
                    const element = e.target.closest(".tutorial-link, .tutorial-cta, .play-btn");
                    const card = element.closest(".tutorial-card");
                    if (card) {
                        const tutorialId = card.querySelector("[data-tutorial-id]")?.getAttribute("data-tutorial-id");
                        if (tutorialId) {
                            TutorialManager.openTutorial(tutorialId);
                        }
                    }
                }
            });
        },
        
        initializeFilters: function() {
            this.allCards = Array.from(document.querySelectorAll(".tutorial-card"));
            this.currentFilter = "all";
            this.currentSearch = "";
        },
        
        setupSearch: function() {
            const searchInput = document.getElementById("tutorial-search");
            if (searchInput) {
                searchInput.addEventListener("input", function() {
                    TutorialManager.currentSearch = this.value.toLowerCase();
                    TutorialManager.applyFilters();
                });
            }
        },
        
        handleFilter: function(button) {
            // Update button states
            document.querySelectorAll(".filter-btn").forEach(btn => {
                btn.classList.remove("active");
                btn.setAttribute("aria-pressed", "false");
            });
            
            button.classList.add("active");
            button.setAttribute("aria-pressed", "true");
            
            // Apply filter
            this.currentFilter = button.getAttribute("data-filter");
            this.applyFilters();
        },
        
        applyFilters: function() {
            let visibleCount = 0;
            
            this.allCards.forEach(card => {
                const difficulty = card.getAttribute("data-difficulty");
                const title = card.getAttribute("data-title");
                const description = card.getAttribute("data-description");
                
                // Check filter
                const matchesFilter = this.currentFilter === "all" || difficulty === this.currentFilter;
                
                // Check search
                const matchesSearch = !this.currentSearch || 
                    title.includes(this.currentSearch) || 
                    description.includes(this.currentSearch);
                
                if (matchesFilter && matchesSearch) {
                    card.style.display = "block";
                    visibleCount++;
                } else {
                    card.style.display = "none";
                }
            });
            
            // Show/hide empty state
            const emptyState = document.getElementById("no-results");
            if (emptyState) {
                emptyState.style.display = visibleCount === 0 ? "block" : "none";
            }
        },
        
        openTutorial: function(tutorialId) {
            const modal = document.getElementById("tutorial-modal");
            const title = document.getElementById("tutorial-modal-title");
            const content = document.getElementById("tutorial-modal-content");
            
            // Find tutorial data
            const card = document.querySelector(`[data-tutorial-id="${tutorialId}"]`)?.closest(".tutorial-card");
            if (!card) return;
            
            const tutorialTitle = card.querySelector(".tutorial-title a")?.textContent || "Tutorial";
            
            // Update modal
            title.textContent = tutorialTitle;
            content.innerHTML = `
                <div class="tutorial-video-container">
                    <div class="video-placeholder">
                        <i class="fa fa-play-circle fa-4x" aria-hidden="true"></i>
                        <p>Video tutorial would be embedded here</p>
                        <p class="text-muted">Tutorial ID: ${tutorialId}</p>
                    </div>
                </div>
            `;
            
            // Open modal
            ModernAgentModal.openModal({ target: modal });
        }
    };
    
    // Global function for clear filters button
    window.clearFilters = function() {
        const searchInput = document.getElementById("tutorial-search");
        const allButton = document.querySelector(".filter-btn[data-filter=\"all\"]");
        
        if (searchInput) searchInput.value = "";
        if (allButton) TutorialManager.handleFilter(allButton);
        
        TutorialManager.currentSearch = "";
        TutorialManager.currentFilter = "all";
        TutorialManager.applyFilters();
    };
    
    // Initialize when DOM is ready
    document.addEventListener("DOMContentLoaded", function() {
        TutorialManager.init();
    });
    
    // Expose for manual use
    window.TutorialManager = TutorialManager;
})();
';

// Load the base template
$this->load->view('templates/base', $template_data);
?> 
