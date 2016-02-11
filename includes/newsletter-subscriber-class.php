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
			var_dump($instance);
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
						<input type="text" id="name" name="name" class="form-control" required placeholder="<? _e('Name Placeholder','ns_domain');?>">
					</div>
					<div class="form-group">
						<input type="text" id="email" name="email" class="form-control" required placeholder="<? _e('Email Placeholder','ns_domain');?>">
					</div>
					<br />
					<input type="hidden" name="recipient" value="<?=$instance['recipient']?>">
					<input type="hidden" name="subject" value="<?=$instance['subject']?>">
					<input type="hidden" name="writingToFileEnable" value="<?=$instance['writingToFileEnable']?>">
					<input type="submit" class="btn btn-primary" name="subcriber_submit" value="<?=$instance['subscribeInput']?>">
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
		$title = !empty($instance['title']) ? $instance['title'] : __('Pop Up Subscriber Form','ns_domain');
		$recipient = !empty($instance['recipient']) ? $instance['recipient'] : 'email@email.com';
		$subject = !empty($instance['subject']) ? $instance['subject'] : __('New subscriber','ns_domain');
		$subscribeInput = !empty($instance['subscribeInput']) ? $instance['subscribeInput'] : __('Subscribe','ns_domain');
		$successMessage = !empty($instance['successMessage']) ? $instance['successMessage'] : 'You are now subscribed';
		$showingCounter = !empty($instance['counter']) ? $instance['counter'] : '3';
		$writingToFileEnable = ! empty( $instance['writingToFileEnable'] ) ? $instance['writingToFileEnable'] : '1';
		$checked = $instance['writingToFileEnable'] == '1' ? 'checked' : '';
		?>
		<p>
			<label for="<?=$this->get_field_id('title')?>"><? _e('Pop-up Title:','ns_domain');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?=$this->get_field_id('recipient')?>"><? _e('Recipient Email:','ns_domain');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'recipient' ); ?>" name="<?php echo $this->get_field_name( 'recipient' ); ?>" type="text" value="<?php echo esc_attr( $recipient ); ?>">
		</p>
		<p>
			<label for="<?=$this->get_field_id('subject')?>"><? _e('Email Subject:','ns_domain');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'subject' ); ?>" name="<?php echo $this->get_field_name( 'subject' ); ?>" type="text" value="<?php echo esc_attr( $subject ); ?>">
		</p>
		<p>
			<label for="<?=$this->get_field_id('subscribeInput')?>"><? _e('Subscribe Button Text:','ns_domain');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'subscribeInput' ); ?>" name="<?php echo $this->get_field_name( 'subscribeInput' ); ?>" type="text" value="<?php echo esc_attr( $subscribeInput ); ?>">
		</p>
		<p>
			<label for="<?=$this->get_field_id('successMessage')?>"><? _e('Success message:','ns_domain');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'successMessage' ); ?>" name="<?php echo $this->get_field_name( 'successMessage' ); ?>" type="text" value="<?php echo esc_attr( $successMessage ); ?>">
		</p>
		<p>
			<label for="<?=$this->get_field_id('counter')?>"><? _e('How many times show pop-up:','ns_domain');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'counter' ); ?>" name="<?php echo $this->get_field_name( 'counter' ); ?>" type="number" min="0" max="100" step="1" value="<?php echo esc_attr( $showingCounter ); ?>">
		</p>
		<p>
			<label for="<?=$this->get_field_id('writingToFileEnable')?>"><? _e('Write to subscribers_list.csv file:','ns_domain');?></label>&nbsp;&nbsp;
			<input type="checkbox" id="<?php echo $this->get_field_id( 'writingToFileEnable' ); ?>" name="<?php echo $this->get_field_name( 'writingToFileEnable' ); ?>" value="<?php echo esc_attr( $writingToFileEnable ); ?>" <?=$checked?>>
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
		$instance['subscribeInput'] = ( ! empty( $new_instance['subscribeInput'] ) ) ? strip_tags( $new_instance['subscribeInput'] ) : '';
		$instance['successMessage'] = ( ! empty( $new_instance['successMessage'] ) ) ? strip_tags( $new_instance['successMessage'] ) : '';
		$instance['counter'] = ( ! empty( $new_instance['counter'] ) ) ? strip_tags( $new_instance['counter'] ) : '';
		$instance['writingToFileEnable'] = ( ! empty( $new_instance['writingToFileEnable'] ) ) ? strip_tags( $new_instance['writingToFileEnable'] ) : '0';
		return $instance;
	}
}