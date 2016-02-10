<?


 class Newsletter_Subscriber_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		parent::__construct(
		'newsletter_subscriber_widget', // Base ID
		__( 'My Pop Up Subscriber Form','ns_domain' ), // Name
		array( 'description' => __( 'Just My Pop Up Subscriber Form','ns_domain' ), ) // Args
	 );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		
		// outputs the content of the widget
		?>
			<div onclick="pop_up_subs_form_hide_order();" id="pop_up_subs_form_overlay">&nbsp;</div>
			<div id="pop_up_subs_form">
		<?
			echo $args['before_widget'];
			
			echo $args['before_title'];
				if(!empty($instance['title'])){
					echo $instance['title'];
				}
			echo $args['after_title'];
			?>
				<div id="form-msg"></div>
				<form action="<?=plugins_url().'/subscriber_pop_up_form_wp/includes/newsletter-subscriber-mailer.php'?>" method="post" id="subscriber-form">
					<div class="form-group">
						<label for="name">Name:</label><br />
						<input type="text" id="name" name="name" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="email">Email:</label><br />
						<input type="text" id="email" name="email" class="form-control" required>
					</div>
					<br />
					<input type="hidden" name="recipient" value="<?=$instance['recipient']?>">
					<input type="hidden" name="subject" value="<?=$instance['subject']?>">
					<input type="submit" class="btn btn-primary" name="subcriber_submit" value="Subscribe">
					<br />
					<br />
				</form>
			<?
			echo $args['after_widget'];
		?>
		</div>
		<?
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		$title = !empty($instance['title']) ? $instance['title'] : __('My Pop Up Subscriber Form','ns_domain');
		$recipient = $instance['recipient'];
		$subject = !empty($instance['subject']) ? $instance['subject'] : __('You have a new subscriber','ns_domain');
		
		?>
		<p>
			<label for="<?=$this->get_field_id('title')?>"><? _e('Title:');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?=$this->get_field_id('recipient')?>"><? _e('recipient:');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'recipient' ); ?>" name="<?php echo $this->get_field_name( 'recipient' ); ?>" type="text" value="<?php echo esc_attr( $recipient ); ?>">
		</p>
		<p>
			<label for="<?=$this->get_field_id('subject')?>"><? _e('subject:');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'subject' ); ?>" name="<?php echo $this->get_field_name( 'subject' ); ?>" type="text" value="<?php echo esc_attr( $subject ); ?>">
		</p>	
		<?
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['recipient'] = ( ! empty( $new_instance['recipient'] ) ) ? strip_tags( $new_instance['recipient'] ) : '';
		$instance['subject'] = ( ! empty( $new_instance['subject'] ) ) ? strip_tags( $new_instance['subject'] ) : '';
		return $instance;
	}
}