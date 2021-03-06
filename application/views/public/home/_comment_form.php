<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div id="form-comment">
	<h2>Comment :</h2>		
	<form action="" method="POST" >
		<p class="p-comment">
			<label class="label-comment" for="name">Name</label>
			<input size="40" type="text" value="<?php echo set_value('name',$post_comment->author)?>" placeholder="Enter your name here" name="name" />
			<?php echo form_error('name','<span class="field-message">','</span>') ?>
		</p>
		<p class="p-comment">
			<label class="label-comment" for="email">Email</label>
			<input size="40" type="text" value="<?php echo set_value('email',$post_comment->email)?>" placeholder="Enter your email here" name="email" />
			<?php echo form_error('email','<span class="field-message">','</span>') ?>
		</p>
		<p class="p-comment">
			<label class="label-comment" for="website">Website</label>
			<input size="40" type="text" value="<?php echo set_value('website',$post_comment->url)?>" placeholder="Enter your website here" name="website" />
			<?php echo form_error('website','<span class="field-message">','</span>') ?>
		</p>
		<p class="p-comment">
			<label class="label-comment" for="captcha">Captcha</label>
			<?php echo $captcha;?>
			<input size="40" type="text" placeholder="Enter your website here" name="captcha" />
			<?php echo form_error('captcha','<span class="field-message">','</span>') ?>
		</p>
		<p class="p-comment">
			<label class="label-comment" for="comment">Comment</label>
			<textarea cols="29" rows="7" placeholder="Enter your comment here" name="comment"><?php echo set_value('comment',$post_comment->content)?></textarea>
			<?php echo form_error('comment','<span class="field-message">','</span>') ?>
		</p>
		<p class="p-comment">
			<input type="submit" value="Send" />
		</p>
	</form>
</div>

<?php foreach($post->comments as $comment):?>
	<code>
		<h3>Comment from : <?php echo $comment->author;?> | <?php echo $comment->created_at->format('datetime');?></h3>
		<p><?php echo $comment->content;?></p>
	</code>
<?php endforeach;?>