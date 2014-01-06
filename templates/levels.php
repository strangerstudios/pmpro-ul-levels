<?php 
global $wpdb, $pmpro_msg, $pmpro_msgt, $pmpro_levels, $current_user, $pmpro_currency_symbol;
if($pmpro_msg)
{
?>
<div class="message <?php echo $pmpro_msgt?>"><?php echo $pmpro_msg?></div>
<?php
}
?>
	<div id="pmpro_levels">
		<?php	
			$count = 0;
			foreach($pmpro_levels as $level)
			{
			  if(isset($current_user->membership_level->ID))
				  $current_level = ($current_user->membership_level->ID == $level->id);
			  else
				  $current_level = false;
			?>
			<div id="pmpro_level-<?php echo $level->id; ?>" class="pmpro_level<?php if($current_level == $level) { ?> pmpro_level-active<?php } ?>">
				<ul class="pricing-table">
					<li class="title pmpro_level_title"><?php echo $current_level ? "<strong>{$level->name}</strong>" : $level->name?></li>
					<li class="price pmpro_level_price">
						<?php 
							if(pmpro_isLevelFree($level)) 
								_e('Free', 'pmpro');
							else 
								echo pmpro_getLevelCost($level);
						?>
					</li>
					<?php if(!empty($level->description)) { ?>
					<li class="description pmpro_level_description">
						<?php echo stripslashes($level->description); ?>
					</li>
					<?php } ?>
					<?php
						$expiration_text = pmpro_getLevelExpiration($level);
						if($expiration_text)
						{
							?>
							<li class="bullet-item pmpro_level_expiration">
								<?php echo $expiration_text?>
							</li>
							<?php
						}
					?>
					<li class="pmpro_level_button cta-button">
						<?php if(empty($current_user->membership_level->ID)) { ?>
							<a class="button pmpro_btn-select" href="<?php echo pmpro_url("checkout", "?level=" . $level->id, "https")?>"><?php _e('Buy Now', 'Choose a level from levels page', 'pmpro');?></a>               
						<?php } elseif ( !$current_level ) { ?>                	
							<a class="button pmpro_btn-select"href="<?php echo pmpro_url("checkout", "?level=" . $level->id, "https")?>"><?php _e('Buy Now', 'Choose a level from levels page', 'pmpro');?></a>       			
						<?php } elseif($current_level) { ?>      
							<a class="button disabled"href="<?php echo pmpro_url("account")?>"><?php _e('Your&nbsp;Level', 'pmpro');?></a>
						<?php } ?>
					</li>
				</ul>
			</div> <!-- end pmpro_level -->
			<?php
			}
		?>
		<nav id="nav-below" class="navigation" role="navigation">
			<div class="nav-previous alignleft">
				<?php if(!empty($current_user->membership_level->ID)) { ?>
					<a href="<?php echo pmpro_url("account")?>"><?php _e('&larr; Return to Your Account', 'pmpro');?></a>
				<?php } else { ?>
					<a href="<?php echo home_url()?>"><?php _e('&larr; Return to Home', 'pmpro');?></a>
				<?php } ?>
			</div>
		</nav>
	</div>  <!-- end #pmpro_levels -->