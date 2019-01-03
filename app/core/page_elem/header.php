<section id="<?php echo $elemId; ?>" class="header" 
        <?php if( file_exists( $img = "app/res/img/header.jpg") ) 
            echo 'style="background-image: url(app/res/img/header.jpg)"' ?>>
            
		<?php LoadToolBar(); ?>
		
		<div class="vertical-center container">
			<?php ReadMd($content_folder, 'content'); ?>
		</div>
		
</section>
