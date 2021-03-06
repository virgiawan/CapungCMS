<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- BREADCUMB -->
<h2>
	<a href="<?php echo site_url('admin/dashboard');?>">Dashboard</a> &raquo;
	<a href="<?php echo site_url('admin/video')?>">Video</a> &raquo;
	<a href="#" class="active">View</a>
</h2>
<!-- END OF BREADCUMB -->

<!-- MAIN CONTENT -->
<div id="main">
	<h3>View Video : <?php echo $post->title?><a class="btn_add" href="<?php echo  site_url('admin/video') ?>">[ Cancel ]</a> </h3>
	<table>
		<tr class="odd">
			<td width="20%">Publish date</td>
			<td><?php echo $post->publish_date->format('datetime');?></td>
		</tr>
		<tr class="odd">
			<td width="20%">Title</td>
			<td><?php echo $post->title;?></td>
		</tr>
		<?php if($this->config->item('capung_dual_lang')):?>
		<tr class="odd">
			<td>Title (lang)</td>
			<td><?php echo $post->title_alt;?></td>
		</tr>
		<?php endif;?>
		<tr class="odd">
			<td>Resume</td>
			<td align="justify"><?php echo $post->resume;?></td>
		</tr>
		<?php if($this->config->item('capung_dual_lang')):?>
		<tr class="odd">
			<td>Resume (lang)</td>
			<td align="justify"><?php echo $post->resume_alt;?></td>
		</tr>
		<?php endif;?>
		<?php if(!empty($post->filename)):?>
		<tr class="odd">
			<td>Video</td>
			<td>
				<!-- JPLAYER DIV -->
				<div class="jp-video jp-video-270p">
			        <div class="jp-type-single">
			            <div id="jquery_jplayer_2" class="jp-jplayer"></div>
			            <div id="jp_interface_2" class="jp-interface">
			                <div class="jp-video-play"></div>
			                <ul class="jp-controls">
			                    <li><a href="#" class="jp-play" tabindex="1">play</a></li>
			                    <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
			                    <li><a href="#" class="jp-stop" tabindex="1">stop</a></li>
			                    <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
			                    <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
			                </ul>
			                <div class="jp-progress">
			                    <div class="jp-seek-bar">
			                        <div class="jp-play-bar"></div>
			                    </div>
			                </div>
			                <div class="jp-volume-bar">
			                    <div class="jp-volume-bar-value"></div>
			                </div>
			                <div class="jp-current-time"></div>
			                <div class="jp-duration"></div>
			            </div>
			            <div id="jp_playlist_2" class="jp-playlist">
			                <ul>
			                    <li>Filename : <?php echo $post->filename?></li>
			                    <li>Url : <?php echo base_url('uploads/files/'.$post->filename)?></li>
			                </ul>
			            </div>
			        </div>
			    </div>
				<!-- END OF JPLAYER DIV -->
			</td>
		</tr>
		<?php endif;?>
		<tr class="odd">
			<td>Status</td>
			<td><?php echo $post->is_published==0?'No':'Yes'; ?></td>
		</tr>
		<tr class="odd">
			<td>Order Number</td>
			<td><?php echo $post->order_num; ?></td>
		</tr>
	</table>
</div>
<!-- END OF AIN CONTENT -->

<!-- JQUERY VIDEO PLAYER CONFIGURATION -->

<!-- END OF JQUERY VIDEO PLAYER CONFIGURATION -->