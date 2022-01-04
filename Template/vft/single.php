<? get_header(); ?>
<div class="post-container" itemscope itemtype="http://schema.org/Article">
<div class="container">
    <div class="single-post">
        <?
        $currentid = get_the_ID(); 
        while ( have_posts() ) :
        ?>
        <div class="single-post__header">
            <a href="javascript:history.back()" class="back-btn"><svg width="11" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1.39659 0.5L5.5 3.75864L9.60341 0.5L10.5 1.52935L5.5 5.5L0.5 1.52935L1.39659 0.5Z" fill="#303236"></path>
            </svg></a>
			<h1 hidden="true" itemprop="headline name">
				<? single_post_title(); ?>
			</h1>
            <h2 class="single-post__title"><? single_post_title(); ?></h2>
			<a href="/blog" class="back-btn-desktop">Return to recent blog posts</a>
        </div>
		<div class="single-post__line">
        <div class="single-post__before-content" itemscope itemtype="http://schema.org/ImageObject">
			<p hidden="true" itemprop="name">
				<? single_post_title(); ?>
			</p>
			<p hidden="true" itemprop="description">
				<? single_post_title(); ?> post image
			</p>
			<?
			function post_thumb(){
			$currentid = get_the_ID();
			$urli = get_the_post_thumbnail_url($currentid);
			if ($urli == null){
				null;
			}
			else{
				echo '<img src="'.$urli.'" alt="Post thumbnail" itemprop="contentUrl">';
			}
			}
            post_thumb();
			?>
            			<div class="single-post__meta-mobile">
				<div class="single-post__post-date">
					<p class="single-post__date" itemprop="datePublished"><? echo get_the_date(); ?></p>
				</div>
			<div class="single-post__category"> <p class="single-post__category-before">
				Category: &nbsp
				</p>
        <?php the_category('', 'single'); ?>
      		</div>
				<p class="single-post__meta-separator">
					|
				</p>
			<div class="single-post__author">
			<p class="single-post__author-before">
				Author: &nbsp
			</p>
			<?php $author_id=$post->post_author; ?>
			<?php the_author_meta( 'user_nicename' , $author_id ); ?>
			</div>
			</div>
			<div class="post-share__links_desktop">
				<h3 class="post-share__title">Share</h3>
            <script src="https://yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-curtain data-size="l" data-lang="en" data-services="facebook,twitter,linkedin"></div>
            </div>
        </div>
        <div class="single-post__content" >
			<div class="single-post__meta">
				<div class="single-post__post-date">
					<p class="single-post__date" itemprop="datePublished"><? echo get_the_date(); ?></p>
				</div>
			<div class="single-post__category"> <p class="single-post__category-before">
				Category: &nbsp
				</p>
        <?php the_category('', 'single'); ?>
      		</div>
				<p class="single-post__meta-separator">
					|
				</p>
			<div class="single-post__author">
			<p class="single-post__author-before" itemprop="author" itemscope="" itemtype="http://schema.org/Person">
				Author: &nbsp
			</p>
				<span itemprop="author" itemscope="" itemtype="http://schema.org/Person">
			<?php $author_id=$post->post_author; ?>
			<?php the_author_meta( 'user_nicename' , $author_id ); ?>
				</span>
			</div>
			</div>
			<div itemprop="articleBody">
				
			<?
        the_post();
        the_content();
        ?>
			</div>
        </div>
		</div>
        <div class="signle-post__share post-share">
			<div class="single-post__line">
            <div class="post-share__links_mobile">
				<h3 class="post-share__title">Share the</h3>
            <script src="https://yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-curtain data-size="l" data-lang="en" data-services="facebook,twitter,linkedin"></div>
            </div>
        <div class="single-post__comments">
		<h2 class="comments-title">
			Comments
			</h2>
        <? if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif; ?>
        </div>
		</div>
        <div class="single-post__navigation">
        <? the_post_navigation( array(
            'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'vitatemplate' ) . '</span> ' .
                '<span class="screen-reader-text">' . __( 'Next post:', 'vitatemplate' ) . '</span> ' .
                '<span class="post-title">%title</span>',
            'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'vitatemplate' ) . '</span> ' .
                '<span class="screen-reader-text">' . __( 'Previous post:', 'vitatemplate' ) . '</span> ' .
                '<span class="post-title">%title</span>',
        ) );
        endwhile; ?>
        </div>
    </div>
</div>
</div>
<?get_footer(); ?>