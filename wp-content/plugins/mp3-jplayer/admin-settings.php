<?php


function drawSplashScreen_mp3j ()
{
	echo '<br><br><br><p>Thanks for updating!</p><br><br>';
}


function mp3j_print_admin_page()
{ 
	
	global $MP3JP;
	$O = $MP3JP->getAdminOptions();
	$colours_array = array();
	
	
	if ( isset( $_POST['update_mp3foxSettings'] ) )
	{
		//prep/sanitize values
		if (isset($_POST['mp3foxVol'])) {
			$O['initial_vol'] = preg_replace("/[^0-9]/", "", $_POST['mp3foxVol']); 
			if ($O['initial_vol'] < 0 || $O['initial_vol']=="") { $O['initial_vol'] = "0"; }
			if ($O['initial_vol'] > 100) { $O['initial_vol'] = "100"; }
		}
		if (isset($_POST['mp3foxPopoutMaxHeight'])) {
			$O['popout_max_height'] = preg_replace("/[^0-9]/", "", $_POST['mp3foxPopoutMaxHeight']); 
			if ( $O['popout_max_height'] == "" ) { $O['popout_max_height'] = "750"; }
			if ( $O['popout_max_height'] < 200 ) { $O['popout_max_height'] = "200"; }
			if ( $O['popout_max_height'] > 1200 ) { $O['popout_max_height'] = "1200"; }
		}
		if (isset($_POST['mp3foxPopoutWidth'])) {
			$O['popout_width'] = preg_replace("/[^0-9]/", "", $_POST['mp3foxPopoutWidth']); 
			if ( $O['popout_width'] == "" ) { $O['popout_width'] = "400"; }
			if ( $O['popout_width'] < 250 ) { $O['popout_width'] = "250"; }
			if ( $O['popout_width'] > 1600 ) { $O['popout_width'] = "1600"; }
		}
		if (isset($_POST['mp3foxMaxListHeight'])) {
			$O['max_list_height'] = preg_replace("/[^0-9]/", "", $_POST['mp3foxMaxListHeight']); 
			if ( $O['max_list_height'] < 0 ) { $O['max_list_height'] = ""; }
		}
		if (isset($_POST['mp3foxfolder'])) { 
			$O['mp3_dir'] = $MP3JP->prep_path( $_POST['mp3foxfolder'] ); 
		}
		if (isset($_POST['mp3foxPopoutBGimage'])) { 
			$O['popout_background_image'] = $MP3JP->prep_path( $_POST['mp3foxPopoutBGimage'] );
		}
		
		$O['dloader_remote_path'] = ( isset($_POST['dloader_remote_path']) ) ? $MP3JP->prep_value( $_POST['dloader_remote_path'] ) : "";
		$O['loggedout_dload_link'] = ( $_POST['loggedout_dload_link'] == "" ) ? "" : $MP3JP->prep_value( $_POST['loggedout_dload_link'] ); //allow it to be empty
		
		if (isset($_POST['mp3foxFloat'])) {
			$O['player_float'] = $MP3JP->prep_value( $_POST['mp3foxFloat'] );
		}
		if (isset($_POST['librarySortcol'])) { 
			$O['library_sortcol'] = $MP3JP->prep_value( $_POST['librarySortcol'] );
		}
		if (isset($_POST['libraryDirection'])) {
			$O['library_direction'] = $MP3JP->prep_value( $_POST['libraryDirection'] );
		}
		if (isset($_POST['folderFeedSortcol'])) { 
			$O['folderFeedSortcol'] = $MP3JP->prep_value( $_POST['folderFeedSortcol'] );
		}
		if (isset($_POST['folderFeedDirection'])) {
			$O['folderFeedDirection'] = $MP3JP->prep_value( $_POST['folderFeedDirection'] );
		}
		if (isset($_POST['file_separator'])) {
			$O['f_separator'] = $MP3JP->prep_value( $_POST['file_separator'] );
		}
		if (isset($_POST['caption_separator'])) {
			$O['c_separator'] = $MP3JP->prep_value( $_POST['caption_separator'] );
		}
		if (isset($_POST['mp3foxDownloadMp3'])) { 
			$O['show_downloadmp3'] = $MP3JP->prep_value( $_POST['mp3foxDownloadMp3'] ); 
		}
		if (isset($_POST['replacerShortcode_playlist'])) {
			$O['replacerShortcode_playlist'] = $MP3JP->prep_value( $_POST['replacerShortcode_playlist'] );
		}
		if (isset($_POST['replacerShortcode_single'])) {
			$O['replacerShortcode_single'] = $MP3JP->prep_value( $_POST['replacerShortcode_single'] );
		}
		if (isset($_POST['showErrors'])) {
			$O['showErrors'] = $MP3JP->prep_value( $_POST['showErrors'] );
		}
		
	
		$O['playerTitle1'] = ( isset( $_POST['playerTitle1'] ) ) ? $MP3JP->prep_value( $_POST['playerTitle1'] ) : '';
		$O['playerTitle2'] = ( isset( $_POST['playerTitle2'] ) ) ? $MP3JP->prep_value( $_POST['playerTitle2'] ) : '';
		
		
		$O['mp3tColour_on'] = ( isset($_POST['mp3tColour_on']) ) ? "true" : "false";
		if (isset($_POST['mp3tColour'])) {
			$O['mp3tColour'] = $MP3JP->prep_value( $_POST['mp3tColour'] );
		}
		$O['mp3jColour_on'] = ( isset($_POST['mp3jColour_on']) ) ? "true" : "false";
		if (isset($_POST['mp3jColour'])) {
			$O['mp3jColour'] = $MP3JP->prep_value( $_POST['mp3jColour'] );
		}
		
		$O['echo_debug'] 			= ( isset($_POST['mp3foxEchoDebug']) ) 			? "true" : "false";
		$O['add_track_numbering'] 	= ( isset($_POST['mp3foxAddTrackNumbers']) ) 	? "true" : "false";
		$O['enable_popout'] 		= ( isset($_POST['mp3foxEnablePopout']) ) 		? "true" : "false";
		$O['playlist_repeat'] 		= ( isset($_POST['mp3foxPlaylistRepeat']) ) 	? "true" : "false";
		$O['encode_files'] 			= ( isset($_POST['mp3foxEncodeFiles']) ) 		? "true" : "false";
		$O['run_shcode_in_excerpt'] = ( isset($_POST['runShcodeInExcerpt']) ) 		? "true" : "false";
		$O['volslider_on_singles'] 	= ( isset($_POST['volslider_onsingles']) ) 		? "true" : "false";
		$O['volslider_on_mp3j'] 	= ( isset($_POST['volslider_onmp3j']) ) 		? "true" : "false";
		//$O['touch_punch_js'] 		= ( isset($_POST['touch_punch_js']) ) 			? "true" : "false";
		$O['force_browser_dload'] 	= ( isset($_POST['force_browser_dload']) ) 		? "true" : "false";
		$O['make_player_from_link']	= ( isset($_POST['make_player_from_link']) )	? "true" : "false";
		$O['auto_play'] 			= ( isset($_POST['mp3foxAutoplay']) ) 			? "true" : "false";
		$O['allow_remoteMp3'] 		= ( isset($_POST['mp3foxAllowRemote']) ) 		? "true" : "false";
		$O['player_onblog'] 		= ( isset($_POST['mp3foxOnBlog']) ) 			? "true" : "false";
		$O['playlist_show'] 		= ( isset($_POST['mp3foxShowPlaylist']) ) 		? "true" : "false";
		$O['remember_settings'] 	= ( isset($_POST['mp3foxRemember']) ) 			? "true" : "false";
		$O['hide_mp3extension'] 	= ( isset($_POST['mp3foxHideExtension']) ) 		? "true" : "false";
		$O['replace_WP_playlist'] 	= ( isset($_POST['replace_WP_playlist']) ) 		? "true" : "false";
		$O['replace_WP_audio'] 		= ( isset($_POST['replace_WP_audio']) ) 		? "true" : "false";
		$O['replace_WP_embedded'] 	= ( isset($_POST['replace_WP_embedded']) ) 		? "true" : "false";
		$O['replace_WP_attached'] 	= ( isset($_POST['replace_WP_attached']) ) 		? "true" : "false";
		$O['autoCounterpart'] 		= ( isset($_POST['autoCounterpart']) ) 			? "true" : "false";
		$O['allowRangeRequests'] 	= ( isset($_POST['allowRangeRequests']) ) 		? "true" : "false";
		
		$O['flipMP3j'] 				= ( isset($_POST['flipMP3j']) ) 				? "false" : "true";
		$O['flipMP3t'] 				= ( isset($_POST['flipMP3t']) ) 				? "true" : "false";
		
		$O['hasListMeta'] 			= ( isset($_POST['hasListMeta']) ) 				? "true" : "false";
		$O['autoResume'] 			= ( isset($_POST['autoResume']) ) 				? "true" : "false";
		
		
		//$O['libUseID3'] 			= ( isset($_POST['libUseID3']) ) 				? "true" : "false";
		
		$O['paddings_top'] 			= ( $_POST['mp3foxPaddings_top'] == "" ) 	? "0px" : $MP3JP->prep_value( $_POST['mp3foxPaddings_top'] );
		$O['paddings_bottom'] 		= ( $_POST['mp3foxPaddings_bottom'] == "" ) ? "0px" : $MP3JP->prep_value( $_POST['mp3foxPaddings_bottom'] );
		$O['paddings_inner'] 		= ( $_POST['mp3foxPaddings_inner'] == "" ) 	? "0px" : $MP3JP->prep_value( $_POST['mp3foxPaddings_inner'] );
		$O['font_size_mp3t'] 		= ( $_POST['font_size_mp3t'] == "" ) 		? "14px" : $MP3JP->prep_value( $_POST['font_size_mp3t'] );
		$O['font_size_mp3j'] 		= ( $_POST['font_size_mp3j'] == "" ) 		? "14px" : $MP3JP->prep_value( $_POST['font_size_mp3j'] );
		$O['dload_text'] 			= ( $_POST['dload_text'] == "" ) 			? "" : $MP3JP->strip_scripts( $_POST['dload_text'] );
		$O['loggedout_dload_text'] 	= ( $_POST['loggedout_dload_text'] == "" ) 	? "" : $MP3JP->strip_scripts( $_POST['loggedout_dload_text'] );
		
		$hasFormat = false;
		foreach ( $O['audioFormats'] as $k => $f ) {
			if ( isset($_POST['audioFormats'][$k]) ) {
				$O['audioFormats'][$k] = "true";
				$hasFormat = true;
			}
			else {
				$O['audioFormats'][$k] = "false";
			}
		}
		if ( ! $hasFormat ) {
			$O['audioFormats']['mp3'] = "true";
		}
		
		if (isset($_POST['mp3foxPlayerWidth'])) { 
			$O['player_width'] = $MP3JP->prep_value( $_POST['mp3foxPlayerWidth'] );
		}
		if (isset($_POST['disableJSlibs'])) {
			$O['disable_jquery_libs'] = ( preg_match("/^yes$/i", $_POST['disableJSlibs']) ) ? "yes" : "";
		}
		if ( isset($_POST['mp3foxPopoutButtonText']) ) {
			$O['popout_button_title'] = $MP3JP->strip_scripts( $_POST['mp3foxPopoutButtonText'] );
		}
		if ( isset($_POST['make_player_from_link_shcode']) ) {
			$O['make_player_from_link_shcode'] = $MP3JP->strip_scripts( $_POST['make_player_from_link_shcode'] );
		}
		if ( isset($_POST['mp3foxPopoutBackground']) ) { 
			$O['popout_background'] = $MP3JP->prep_value( $_POST['mp3foxPopoutBackground'] );
		}
		if ( isset($_POST['mp3foxPluginVersion']) ) { 
			$O['db_plugin_version'] = $MP3JP->prep_value( $_POST['mp3foxPluginVersion'] );
		}
		
		update_option($MP3JP->adminOptionsName, $O);
		$MP3JP->theSettings = $O;
		$MP3JP->setAllowedFeedTypesArrays();
		
		MJPsettings_submit();
		?>
		
		<!-- Settings saved message -->
		<div class="updated"><p><strong><?php _e("Settings saved.", $MP3JP->textdomain );?></strong></p></div>
	<?php 
	}


	$current_colours = $O['colour_settings'];
	?>
	<div class="wrap">
		
		<h2>&nbsp;</h2>
		
		<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
			
			
			<div class="mp3j-tabbuttons-wrap unselectable">
				<div class="mp3j-tabbutton first" id="mp3j_tabbutton_1"><h1>MP3-jPlayer</h1></div>
				<div class="mp3j-tabbutton" id="mp3j_tabbutton_5">Media</div>
				<div class="mp3j-tabbutton" id="mp3j_tabbutton_0">Players</div>
				<div class="mp3j-tabbutton" id="mp3j_tabbutton_3">Downloads</div>
				<div class="mp3j-tabbutton" id="mp3j_tabbutton_4">Popout</div>
				<div class="mp3j-tabbutton last" id="mp3j_tabbutton_2">Advanced</div>
				<br class="clearB" />
			</div>
			
			<div class="mp3j-tabs-wrap">
				
				<!-- TAB 0.......................... -->
				<div class="mp3j-tab" id="mp3j_tab_0">
					
					
					<?php
					MJPsettings_players();
					?>
					
					<div style="float:left; width:270px; margin:8px 10px 0 0;">
						<div class="os" style="border-bottom:1px solid #d3d3d3; padding:8px 0 8px 0px; margin:0 0 15px 0; font-size:18px; font-weight:500;">Text Players (single-file)</div>
						<table class="player-settings" style="margin:0 0 0px 0px; width:260px">
							<tr>
								<td class="psHeight"><strong style="font-size:14px;">Font Size</strong>:</td>
								<td><input type="text" value="<?php echo $O['font_size_mp3t']; ?>" name="font_size_mp3t" style="width:70px;" /></td>
							</tr>
							<tr>
								<td class="psHeight"><label for="volslider_onsingles"><strong style="font-size:14px;">Volume</strong>: &nbsp;</label></td>
								<td><input type="checkbox" name="volslider_onsingles" id="volslider_onsingles" value="true" <?php if ($O['volslider_on_singles'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); }?> /></td>
							</tr>
							<tr>
								<td class="psHeight"><label for="flipMP3t"><strong style="font-size:14px;">Play on RHS</strong>: &nbsp;</label></td>
								<td><input type="checkbox" name="flipMP3t" id="flipMP3t" value="true" <?php if ($O['flipMP3t'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); }?> /></td>
							</tr>
							<tr>
								<td class="psHeight"><strong style="font-size:14px;">Colour Scheme</strong>:</td>
								<td><input type="checkbox" name="mp3tColour_on" id="mp3tColour_on" value="true" <?php if ($O['mp3tColour_on'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); }?> />
									On &nbsp;<input type="text" value="<?php echo $O['mp3tColour']; ?>" name="mp3tColour" id="mp3tColour" /></td>
							</tr>
							<?php
							MJPsettings_mp3t();
							?>
						</table>						
					</div>
					
					<div style="float:left; width:270px; margin:8px 10px 0 0;">
						<div style="border-bottom:1px solid #d3d3d3; padding:8px 0 8px 0px; margin:0 0 15px 0; font-size:18px; font-weight:500;">Button Players (single-file)</div>
						<table class="player-settings" style="margin:0 0 0px 0px; width:260px">
							<tr>
								<td class="psHeight"><strong style="font-size:14px;">Font Size</strong>:</td>
								<td><input type="text" value="<?php echo $O['font_size_mp3j']; ?>" name="font_size_mp3j" style="width:70px;" /></td>
							</tr>
							<tr>
								<td class="psHeight"><label for="volslider_onmp3j"><strong style="font-size:14px;">Volume</strong>: &nbsp;</label></td>
								<td><input type="checkbox" name="volslider_onmp3j" id="volslider_onmp3j" value="true" <?php if ($O['volslider_on_mp3j'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); }?> /></td>
							</tr>
							<tr>
								<td class="psHeight"><label for="flipMP3j"><strong style="font-size:14px;">Play on RHS</strong>: &nbsp;</label></td>
								<td><input type="checkbox" name="flipMP3j" id="flipMP3j" value="false" <?php if ($O['flipMP3j'] == "false") { _e('checked="checked"', $MP3JP->textdomain ); }?> /></td>
							</tr>
							<tr>
								<td class="psHeight"><strong style="font-size:14px;">Colour Scheme</strong>:</td>
								<td><input type="checkbox" name="mp3jColour_on" id="mp3jColour_on" value="true" <?php if ($O['mp3jColour_on'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); }?> />
									On &nbsp;<input type="text" value="<?php echo $O['mp3jColour']; ?>" name="mp3jColour" id="mp3jColour" />
								</td>
							</tr>
							<?php
							MJPsettings_mp3j();
							?>
						</table>
					</div>
					<br class="clearB">
					
					<div>
						<?php
						MJPsettings_after_mp3tj();
						?>
					</div>
					<br class="clearB">
					
					<br>
					<div style="border-bottom:1px solid #d3d3d3; padding:8px 0 8px 0px; margin:10px 0 15px 0; width:540px; font-size:18px; font-weight:500;">Playlist Players</div>
					<table class="playlist-settings" style="margin:0 0 0px 0px;">
						<tr>
							<td style="width:175px;"><strong style="font-size:14px;">Width:</strong></td>
							<td><input type="text" style="width:100px;" name="mp3foxPlayerWidth" value="<?php echo $O['player_width']; ?>" /></td>
							<td><span class="description">Pixels (px) or percent (%).</span></td>
						</tr>
						<tr>
							<td><strong style="font-size:14px;">Alignment:</strong></td>
							<td><select name="mp3foxFloat" style="width:100px;">
									<option value="none" <?php if ( 'none' == $O['player_float'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>Left</option>
									<option value="rel-C" <?php if ( 'rel-C' == $O['player_float'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>Centre</option>
									<option value="rel-R" <?php if ( 'rel-R' == $O['player_float'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>Right</option>
									<option value="left" <?php if ( 'left' == $O['player_float'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>Float Left</option>
									<option value="right" <?php if ( 'right' == $O['player_float'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>Float Right</option>
								</select></td>
							<td></td>
						</tr>
						
						
						
						<tr>
							<td style="padding-bottom:4px;"><strong style="font-size:14px;">Margins:</strong></td>
							<td style="padding-bottom:4px;" colspan="2"><input type="text" size="5" name="mp3foxPaddings_top" value="<?php echo $O['paddings_top']; ?>" /> &nbsp; Above players</td>
						</tr>
						<tr>
							<td style="padding-top:0px; padding-bottom:4px;"></td>
							<td style="padding-top:0px; padding-bottom:4px;" colspan="2"><input type="text" size="5" name="mp3foxPaddings_inner" value="<?php echo $O['paddings_inner']; ?>" /> &nbsp; Inner margin (floated players)</td>
						</tr>
						<tr>
							<td style="padding-top:0px; padding-bottom:2px;"></td>
							<td style="padding-top:0px; padding-bottom:2px;" colspan="2"><input type="text" size="5" name="mp3foxPaddings_bottom" value="<?php echo $O['paddings_bottom']; ?>" /> &nbsp; Below players</td>
						</tr>
						<tr>
							<td style="padding-top:5px; padding-bottom:20px;"></td>
							<td style="padding-top:5px; padding-bottom:20px;" colspan="2"><span class="description">Pixels (px) or percent (%).</span></td>
						</tr>
						
						
						<tr>
							<td style="padding-bottom:0;padding-top:0px;"><label style="font-size:14px;">Max playlist height:</label></td>
							<td style="padding-bottom:0;padding-top:0px;" colspan="2"><input type="text" size="5" name="mp3foxMaxListHeight" value="<?php echo $O['max_list_height']; ?>" /> px</td>
						</tr>
						<tr>
							<td style="padding-bottom:20px;padding-top:0;" colspan="3"><span class="description">A scroll bar will show for longer playlists, leave it blank for no limit.</span></td>
						</tr>					
					
					</table>
					
					
					
					<table class="playlist-settings">
						<tr>
							<td style="width:220px;"><label for="hasListMeta" style="font-size:14px;">Show sub titles in playlists</label></td>
							<td colspan="2"><input type="checkbox" value="true" name="hasListMeta" id="hasListMeta" <?php echo ( $O['hasListMeta'] === "true" ? 'checked="checked"' : ''); ?>/></td>
						</tr>
						<tr>
							<td><label for="mp3foxShowPlaylist" style="font-size:14px;">Start with playlists open</label></td>
							<td colspan="2"><input type="checkbox" name="mp3foxShowPlaylist" id="mp3foxShowPlaylist" value="true" <?php if ($O['playlist_show'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); }?> /></td>
						</tr>
						<tr>
							<td><label for="mp3foxEnablePopout" style="font-size:14px;">Show popout player button</label></td>
							<td colspan="2"><input type="checkbox" name="mp3foxEnablePopout" id="mp3foxEnablePopout" value="true" <?php if ($O['enable_popout'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); }?> /></td>
						</tr>
					</table>
					
					
					
					
					<?php
					MJPsettings_playlist();
					?>
					
				</div><!-- CLOSE TAB -->
			
				
				
				<!-- TAB 1......................... -->
				<div class="mp3j-tab" id="mp3j_tab_1">
					
					<div class="settingsBox">
						<p style="margin-bottom:25px;" class="mainTick"><label>Initial volume: &nbsp; </label>
							<input type="text" style="text-align:center;" size="2" name="mp3foxVol" value="<?php echo $O['initial_vol']; ?>" /> 
							&nbsp; <span class="description">(0 - 100)</span></p>
						
						<p class="mainTick"><input type="checkbox" name="mp3foxAddTrackNumbers" id="mp3foxAddTrackNumbers" value="true" <?php if ($O['add_track_numbering'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); } ?> />
							<label for="mp3foxAddTrackNumbers"> &nbsp; Number the tracks</label></p>
						
						<p class="mainTick"><input type="checkbox" name="mp3foxAutoplay" id="mp3foxAutoplay" value="true" <?php if ($O['auto_play'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); } ?> />
							<label for="mp3foxAutoplay"> &nbsp; Auto play</label> 
							&nbsp;</p>
						
						<p class="mainTick"><input type="checkbox" name="mp3foxPlaylistRepeat" id="mp3foxPlaylistRepeat" value="true" <?php if ($O['playlist_repeat'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); } ?> />
							<label for="mp3foxPlaylistRepeat"> &nbsp; Loop playlist</label></p>
							
						<p class="mainTick"><input type="checkbox" name="autoResume" id="autoResume" value="true" <?php if ($O['autoResume'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); } ?> />
							<label for="autoResume"> &nbsp; Resume playback</label></p>
						
						<p class="description" style="margin-bottom:20px; font-size:14px;"><br><span>Note that Resume and Auto play are prevented by many devices, these will activate on desktops and laptops only.</span> <a class="slimButton" href="javascript:" onclick="jQuery('#resumeHelp').toggle(300);">Help</a></p>	
					
						<div id="resumeHelp" class="helpBox" style="display:none; max-width:550px;">
							<h4>Resume Playback</h4>
							<p class="description">This gives near-continuous listening when browsing the site (there will be a short pause as the next page loads). Resuming will work wherever you have used the same piece of audio on different pages on the site.</p>
							<h4>Auto Play</h4>
							<p class="description">If you set multiple players on a page to autoplay then they will play their playlists in sequence one after the other.</p>
						</div>
						
						
						<br>
						<!-- Auto Counterpart -->
						<input type="checkbox" name="autoCounterpart" id="autoCounterpart" value="true" <?php echo ( $O['autoCounterpart'] === "true" ? 'checked="checked"' : ''); ?>/>
						&nbsp; <label for="autoCounterpart" style="margin:0px 0 0 0px; font-size:14px;">Auto-find counterpart files &nbsp; </label>
						
						
						<p class="description" style="margin:10px 0 0 0px; font-size:14px;">This will pick up a fallback format if it's in the same location as the playlisted track, based on a 
							filename match. <strong><a class="slimButton" href="javascript:" onclick="jQuery('#counterpartHelp').toggle(300);">Help</a></strong></p> 
						
						<div id="counterpartHelp" class="helpBox" style="display:none; max-width:550px;">
							<p class="description">With this option ticked, the plugin will automatically look for counterpart files for any players on a page. The 
								playlisted (primary) track must be from the MPEG family (an mp3, m4a, or mp4 file).</p>
							
							<p class="description">Auto-counterparting works for MPEGS in the library, in local folders, and when using bulk play or FEED commands.
								Just make sure your counterparts have the same filename, and are in the same location as the primary track.</p>
								
							<p class="description">You can always manually add a counterpart to any 
								primary track format by using the <code>counterpart</code> parameter in a shortcode and specifying a url.</p>
							
							<p class="description">Automatic Counterparts are chosen with the following format priority: OGG, WEBM, WAV.</p>
						</div>
					
					
						<br>
					
					</div>
					
					
					<div class="infoBox">
						<?php 
						if ( $O['disable_jquery_libs'] == "yes" ) { 
							echo '<p style="font-weight:600; color:#d33;margin-bottom:10px;">NOTE: jQuery and UI scripts are turned off.</p>';
						} 
						?>
						
						<div class="gettingstarted">
							<h4>Get Started:</h4>
							<p class="infoLinks"><a href="media-new.php">Upload some audio</a></p>
							<p class="infoLinks"><a href="http://mp3-jplayer.com/adding-players/">How to add players</a></p>
							<p class="infoLinks"><a href="http://mp3-jplayer.com/audio-format-advice/">Audio Format Help</a></p>
						</div>
						<br>
						<div class="moreinfo">
							<h4>More Info:</h4>
							<p class="infoLinks"><a href="http://mp3-jplayer.com/help-docs/">Help & Docs main page</a></p>
							<p class="infoLinks"><a href="http://mp3-jplayer.com/shortcode-reference/">Shortcode Reference</a></p>
						</div>
						
						<hr>
						<p class="infoLinks"><a href="http://mp3-jplayer.com">Plugin home page</a></p>
						<p style="margin-bottom:0;" class="r"><span class="description" style="font-size:11px;">Version <?php echo $MP3JP->version_of_plugin; ?></span></p>
						
						
					</div>
					
					
					
					<br class="clearB">
				
					
					
					
				</div><!-- CLOSE START TAB -->
				
				
				
				
				
				<!-- TAB 5.......................... -->
				<div class="mp3j-tab" id="mp3j_tab_5">
					
					
				<?php 					
				$version = substr( get_bloginfo('version'), 0, 3);
				if ( $version >= 3.6 ) {
				?>
					
					<h3 style="margin-top:15px; margin-bottom:10px; font-weight:500;">Library</h3>
					<p class="description" style="font-size:14px; margin-bottom:10px;">Choose which title information to show in the players and playlists when playing from your WordPress Media Library.</p>
					
					<table>
						<tr>
							<td colspan="2"></td>
						</tr>
						<tr>
							<td style="width:135px; height:40px; font-size:14px;"><strong>Main Titles</strong></td>
							<td style="height:40px;"><select name="playerTitle1" id="playerTitle1" style="width:160px;">
									<option value="titles"<?php if ( 'titles' == $O['playerTitle1'] ) { echo ' selected="selected"'; } ?>>Track Title</option>
									<option value="artist"<?php if ( 'artist' == $O['playerTitle1'] ) { echo ' selected="selected"'; } ?>>Artist</option>
									<option value="album"<?php if ( 'album' == $O['playerTitle1'] ) { echo ' selected="selected"'; } ?>>Album</option>
									<option value="excerpts"<?php if ( 'excerpts' == $O['playerTitle1'] ) { echo ' selected="selected"'; } ?>>Caption</option>
									<option value="postDates"<?php if ( 'postDates' == $O['playerTitle1'] ) { echo ' selected="selected"'; } ?>>Upload Date</option>
								</select></td>
						</tr>
						<tr>
							<td style="width:135px; height:40px; font-size:14px;"><strong>Secondary Titles</strong></td>
							<td><select name="playerTitle2" id="playerTitle2" style="width:160px;">
									<option value=""<?php if ( '' == $O['playerTitle2'] ) { echo ' selected="selected"'; } ?>>- None -</option>
									<option value="titles"<?php if ( 'titles' == $O['playerTitle2'] ) { echo ' selected="selected"'; } ?>>Title</option>
									<option value="artist"<?php if ( 'artist' == $O['playerTitle2'] ) { echo ' selected="selected"'; } ?>>Artist</option>
									<option value="album"<?php if ( 'album' == $O['playerTitle2'] ) { echo ' selected="selected"'; } ?>>Album</option>
									<option value="excerpts"<?php if ( 'excerpts' == $O['playerTitle2'] ) { echo ' selected="selected"'; } ?>>Caption</option>
									<option value="postDates"<?php if ( 'postDates' == $O['playerTitle2'] ) { echo ' selected="selected"'; } ?>>Upload Date</option>
								</select></td>
						</tr>
						
					</table>
				<?php
				}
				?>
					
					
					<table style="margin-top:3px;">
						<tr>
							<td style="width:137px; height:40px;"></td>
							<td style="height:40px;">
								<span class="button-secondary unselectable" style="display:inline-block; font-size:13px; font-weight:600; margin-top:-4px;" id="showLibFilesButton">View Files</span>
								&nbsp; &nbsp; <a href="media-new.php" style="font-weight:600; font-size:14px;">Upload Audio &raquo;</a>
							</td>
						</tr>
					</table>
					
					<div id="libraryViewerWrap" style="display:none;">
						<div class="navWrap navWrapHeader">
							<div class="fL">
								<span class="button-secondary unselectable tNavPrev unPad" id="tNavControl_first">&lt;&lt;</span>
								<span class="button-secondary unselectable tNavPrev" id="tNavControl_prev">&lt;</span>
								<select id="tNavControl_page" class="tNavSelect vTop"></select>
								<span class="button-secondary unselectable tNavNext" id="tNavControl_next">&gt;</span>
								<span class="button-secondary unselectable tNavNext unPad" id="tNavControl_last">&gt;&gt;</span>
								&nbsp; &nbsp; &nbsp; &nbsp;<input type="text" value="" id="tNavControl_rows" class="vTop" /> 
							</div>
							<div class="fL tpos ctext">rows per page</div>
							<div class="fL">
								<span id="tNavControl_refresh" class="button-secondary unselectable" style="background:#fff; font-size:11px;">Refresh</span>
								<span class="mjp-spinner" id="tSpinner"></span>
							</div>
							<div class="tNavMessage ctext"></div>
							<br class="clearB" style="height:0px;">
						</div>
						<div id="libraryFilesTable"></div>
					</div>
					<br>
					<hr>
			
					
					
					
					
					<?php
					////
					//Default Folder
					$n = 1;
					$folderInfo = $MP3JP->grabFolderURLs( $O['mp3_dir'] ); //grab all
					$folderText = '';
					//$folderButton = '';
					$folderHtml = '';
					
					if ( is_array($folderInfo) )
					{
						$folderuris = $folderInfo['files'];
						$uploadDates = $folderInfo['dates'];
						foreach ( $folderuris as $i => $uri ) {
							$files[$i] = strrchr( $uri, "/" );
							$files[$i] = str_replace( "/", "", $files[$i] );
						}
						$c = (!empty($files)) ? count($files) : 0;
						
						$folderText .= "<span class=\"tabD\">This folder contains <strong>" . $c . "</strong> audio file" . ( $c != 1 ? 's' : '' ) . "</span>";
						
						if ( $c > 0 ) {
							//$folderButton .= '<span class="button-secondary" href="javascript:" onclick="jQuery(\'#folder-list\').toggle();"><strong style="font-weight:600;">View files</strong></a>';
							
							$folderHtml .= '<div id="folder-list" style="display:none;">';
							$folderHtml .= '<table class="fileList">';
							$folderHtml .= 	'<tr>';
							$folderHtml .= 		'<th>&nbsp;</th>';
							$folderHtml .= 		'<th>Filename</th>';
							$folderHtml .= 		'<th>&nbsp;</th>';
							$folderHtml .= 		'<th>Uploaded</th>';
							$folderHtml .= 	'</tr>';
							
							$rowClass = 'even';
							foreach ( $files as $i => $val ) 
							{										
								$rowClass = ( $rowClass === 'even' ) ? 'odd' : 'even';
								
								$niceDate = date( 'jS F Y', $uploadDates[$i] );
								$folderHtml .= 	'<tr class="' . $rowClass . '">';
								$folderHtml .= 		'<td><span style="color:#aaa;font-size:11px;">' . $n . '</span></td>';
								$folderHtml .= 		'<td>' . $val . '</td>';
								$folderHtml .= 		'<td>&nbsp;</td>';
								$folderHtml .= 		'<td><span class="description">' . $niceDate . '</span></td>';
								$folderHtml .= 	'</tr>';
								$n++;
							}
							$folderHtml .= '</table>';
							$folderHtml .= '</div>';
						}
					}
					elseif ( $folderInfo == true ) {
						$folderText .= "<p class=\"tabD\">Unable to read or locate the folder <code>" . $O['mp3_dir'] . "</code> check the path and folder permissions</p>";
					} 
					else { 
						$folderText .= "<p class=\"tabD\">No info is available on remote folders but you can play from here if you know the filenames</p>"; 
					}
					?>
					
					<br>
					<h3 style="margin-top:10px; margin-bottom:10px; font-weight:500;">Default Folder</h3>
					<p class="description" style="font-size:14px; margin-bottom:10px;">Set a folder path or url below. <a href="javascript:" class="slimButton" onclick="jQuery('#folderHelp').toggle(300);" style="font-size:13px; font-weight:600;">Help</a></p>
					
					<div id="folderHelp" class="helpBox" style="display:none; max-width:550px;">
						<p class="description">If you like, you can specify a location (local or remote) to play some of your audio from. For example:</p>
						<p class="description"><code>/my/music</code> or <code>http://anothersite.com/music</code>.</p>
						<p class="description">This means you only need to write the filenames in playlists to play from this location (you don't need to use the full url).</p>
						<p class="description">If the path is local (on your domain) then you can also bulk-play this folder.</p>
					</div>
					
					
					<table> 
						<tr>
							<td style="font-size:14px; width:135px;"><strong>Folder Path</strong> &nbsp; </td>
							<td style="width:260px;"><input type="text" style="width:250px;" name="mp3foxfolder" value="<?php echo $O['mp3_dir']; ?>" /></td>
							<td style="font-weight:600;"><a class="button-secondary unselectable" href="javascript:" onclick="jQuery('#folder-list').toggle();">View files</a>&nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td></td>
							<td colspan="2" style="padding-left:4px; padding-top:4px;"><?php echo $folderText; ?></td>
						</tr>
					</table>
					<br>
					<?php echo $folderHtml; ?>
					
					
					<hr>
					<br>
					
					
				
					
					
					
					<h3 style="margin-top:10px; font-weight:500;">Bulk-Play Settings</h3>
					<p class="description" style="font-size:14px; margin:10px 0 0 0px;">Choose which audio formats are playlisted when bulk-playing from 
						folders, the library, and via the FEED command in playlists.
						<a href="javascript:" class="slimButton" onclick="jQuery('#feedHelp').toggle(300);">Help</a></p>
					
					<div id="feedHelp" class="helpBox" style="display:none; max-width:550px;">
						<p class="description">Use a simple shortcode in your posts and pages to playlist entire folders that are on your domain. You can also play your entire library.</p>
						
						<p class="description">Play all audio in your library</p>
						<p class="description"><code>[playlist tracks="FEED:LIB"]</code></p>
						
						<p class="description">Play all audio in your default folder</p>
						<p class="description"><code>[playlist tracks="FEED:DF"]</code></p>
						
						<p class="description">Play all audio from the folder http://mysite.com/mytunes</p>
						<p class="description"><code>[playlist tracks="FEED:/mytunes"]</code></p>
						
						<p class="description">Control which of your file types get picked up using the tickboxes below.</p>
					</div>
					
					<p style="margin:15px 0 30px 0; font-size:14px;">
						<?php
						foreach ( $O['audioFormats'] as $k => $f )
						{
							echo '<input class="formatChecker" type="checkbox" name="audioFormats[' .$k. ']" id="audioFormats_' .$k. '" value="true"' . ( $f === 'true' ? ' checked="checked"' : '' ) . '/>';
							echo '<label for="audioFormats_' .$k. '">' .$k. '</label> &nbsp;&nbsp;&nbsp;&nbsp;';
						}
						?>
					</p>
					
					<p class="description" style="font-size:14px; margin:0px 0 10px 0px;">Set the ordering for the playlists when bulk playing.</p>
					
					<table style="margin-left:0px;">								
						<tr>
							<td style="font-size:14px; width:135px;"><strong>Library:</strong></td>
							<td style="font-size:14px;">Order by &nbsp;</td>
							<td>
								<select name="librarySortcol" style="width:160px;">
									<option value="title" <?php if ( 'title' == $O['library_sortcol'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>Title</option>
									<option value="caption" <?php if ( 'caption' == $O['library_sortcol'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>Sub-title, Title</option>
									<option value="file" <?php if ( 'file' == $O['library_sortcol'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>Filename</option>
									<option value="date" <?php if ( 'date' == $O['library_sortcol'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>Date Uploaded</option>
								</select>&nbsp;&nbsp;
							</td>
							<td style="font-size:14px;">&nbsp; Direction &nbsp;</td>
							<td>
								<select name="libraryDirection" style="width:100px;">
									<option value="ASC" <?php if ( 'ASC' == $O['library_direction'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>Asc</option>
									<option value="DESC" <?php if ( 'DESC' == $O['library_direction'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>Desc</option>
								</select>
							</td>
						</tr>
						<tr>
							<td style="font-size:14px; width:135px;"><strong>Folders:</strong></td>
							<td style="font-size:14px;">Order by &nbsp;</td>
							<td>
								<select name="folderFeedSortcol" style="width:160px;">
									<option value="file" <?php if ( 'file' == $O['folderFeedSortcol'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>Filename</option>
									<option value="date" <?php if ( 'date' == $O['folderFeedSortcol'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>Date Uploaded</option>
								</select>&nbsp;&nbsp;
							</td>
							<td style="font-size:14px;">&nbsp; Direction &nbsp;</td>
							<td>
								<select name="folderFeedDirection" style="width:100px;">
									<option value="ASC" <?php if ( 'ASC' == $O['folderFeedDirection'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>Asc</option>
									<option value="DESC" <?php if ( 'DESC' == $O['folderFeedDirection'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>Desc</option>
								</select>
							</td>
						</tr>
					</table>
					
					<br />
					<p style="margin:10px 0 0 0;"><span class="description" id="feedCounterpartInfo"></span></p>
				
				
				
				</div><!-- CLOSE MEDIA TAB -->
				
				
				<!-- DOWNLOADS TAB .......................... -->
				<div class="mp3j-tab" id="mp3j_tab_3">
					<br>
					<p class="description" style="font-size:14px; margin-bottom:10px;">Download buttons are shown on playlist players, use these options to set their behavior.</p>
					
					<table class="dSettingsTable">
						<tr>
							<td><strong class="mainTick">Show Download Button</strong></td>
							<td><select name="mp3foxDownloadMp3" style="width:150px;">
									<option value="true" <?php if ( 'true' == $O['show_downloadmp3'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>Yes</option>
									<option value="false" <?php if ( 'false' == $O['show_downloadmp3'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>No</option>
									<option value="loggedin" <?php if ( 'loggedin' == $O['show_downloadmp3'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>To logged in users</option>
								</select></td>
						</tr>
						<tr>
							<td><strong class="mainTick">Button Text</strong></td>
							<td><input type="text" style="width:150px;" name="dload_text" value="<?php echo $O['dload_text']; ?>" /></td>
						</tr>
						
						<tr>
							<td colspan="2"><br><hr></td>
						</tr>
						
						<tr>
							<td colspan="2" class="mainTick" style="margin-left:0px;"><p class="description" style="margin:0px 0 5px 0px; font-size:14px;">When setting players for logged-in downloads, optionally set the text/link for any logged out visitors.</p></td>
						</tr>
						
						<tr>
							<td><strong class="mainTick">Visitor Text</strong>:</td>
							<td>
								<input type="text" style="width:150px;" name="loggedout_dload_text" value="<?php echo $O['loggedout_dload_text']; ?>" />
							</td>
						</tr>
						<tr>
							<td><strong class="mainTick">Visitor Link</strong>:</td>
							<td>
								<input type="text" style="width:300px;" name="loggedout_dload_link" value="<?php echo $O['loggedout_dload_link']; ?>" />
								&nbsp; <span class="description">Optional URL for the visitor text</span>
							</td>
						</tr>
						
						
						<tr>
							<td colspan="2"><br><hr></td>
						</tr>
						
							
						
						<tr>
							<td style="padding-top:5px;"><label for="force_browser_dload" class="mainTick">Use Smooth Downloading</label></td>
							<td style="padding-top:5px;"><input type="checkbox" name="force_browser_dload" id="force_browser_dload" value="true" <?php if ($O['force_browser_dload'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); }?> /></td>
						</tr>
						<tr>
							<td colspan="2"><p class="description" style="margin:0px 0 0px 0px; font-size:14px;">This option makes downloading seamless for most users, or it will display a dialog box with a link when a seamless download is not possible.</p></td>
						</tr>
						<tr>
							<td colspan="2"><br><hr></td>
						</tr>
					</table>
					
					
					
					
					
					
					
					<table>
						<tr>
							<td><strong class="mainTick">Path to remote downloader file</strong> &nbsp; &nbsp; &nbsp; </td>
							<td>
								<input type="text" style="width:300px;" name="dloader_remote_path" value="<?php echo $O['dloader_remote_path']; ?>" />
							</td>
						</tr>
					</table>
					<p class="description" style="margin:0px 0 10px 4px; font-size:14px;">If you play from other domains and want smooth downloads, then use 
						the field above to specify a path to the downloader file. <strong><a href="<?php echo $MP3JP->PluginFolder; ?>/remote/help.txt">See help on setting this up</a></strong></p>
					
					<br>
					
				</div>
				
				
				
				
				
				<!-- POPOUT TAB .......................... -->
				<div class="mp3j-tab" id="mp3j_tab_4">
					<br>
					<p class="description" style="font-size:14px; margin-bottom:10px;">Set the default text displayed on popout buttons.</p>
					<table class="popoutSettingsTable">
						<tr>
							<td><strong class="mainTick">Launch Button Text</strong>:</td>
							<td><input type="text" style="width:150px;" name="mp3foxPopoutButtonText" value="<?php echo $O['popout_button_title']; ?>" /></td>
						</tr>
						
						<tr>
							<td colspan="2"><br><hr></td>
						</tr>
						<tr>
							<td colspan="2" style="padding-left:0;"><p class="description" style="font-size:14px; margin-bottom:10px;">Popout window settings.</p></td>
						</tr>
						<tr>
							<td><strong class="mainTick">Window Width</strong>:</td>
							<td><input type="text" size="4" style="text-align:center;" name="mp3foxPopoutWidth" value="<?php echo $O['popout_width']; ?>" /> px <span class="description">&nbsp; (250 - 1600)</span></td>
						</tr>
						<tr>
							<td><strong class="mainTick">Window Height</strong>: &nbsp;</td>
							<td><input type="text" size="4" style="text-align:center;" name="mp3foxPopoutMaxHeight" value="<?php echo $O['popout_max_height']; ?>" /> px <span class="description">&nbsp; (200 - 1200) &nbsp; a scroll bar will show for longer playlists</span></td>
						</tr>
						<tr>
							<td><strong class="mainTick">Background Colour</strong>:</td>
							<td><input type="text"name="mp3foxPopoutBackground" style="width:100px;" value="<?php echo $O['popout_background']; ?>" /></td>
						</tr>
						<tr>
							<td><strong class="mainTick">Background Image</strong>:</td>
							<td><input type="text" style="width:100%;" name="mp3foxPopoutBGimage" value="<?php echo $O['popout_background_image']; ?>" /></td>
						</tr>
					</table>
				</div><!-- CLOSE POPOUT TAB -->
				
				
				
				
				
				
				<!--  TAB 2.......................... -->
				<div class="mp3j-tab" id="mp3j_tab_2">
					
					<br>
					<p class="description" style="font-size:14px; margin-bottom:20px;">Choose which aspects of your content you'd like MP3-jPlayer to handle.</p>
					<table class="advancedSettingsTable">
						<tr>
							<td class="mainTick"><input type="checkbox" name="replace_WP_audio" id="replace_WP_audio" value="true" <?php if ($O['replace_WP_audio'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); } ?> /> 
								&nbsp; <label for="replace_WP_audio">Audio Players</label></td>
							<td><span class="description">Use the 'Add Media' Button on post/page edit screens and choose 'Embed Player' from the right select (WP 3.6+).</span></td>
						</tr>
						<tr>
							<td class="mainTick"><input type="checkbox" name="replace_WP_playlist" id="replace_WP_playlist" value="true" <?php if ($O['replace_WP_playlist'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); } ?> /> 
								&nbsp; <label for="replace_WP_playlist">Playlist Players</label></td>
							<td><span class="description">Use the 'Add Media' Button on post/page edit screens and choose 'Audio Playlist' from the left menu (WP 3.9+).</span></td>
						</tr>
						<tr>
							<td class="mainTick"><input type="checkbox" name="make_player_from_link" id="make_player_from_link" value="true" <?php if ($O['make_player_from_link'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); } ?> /> 
								&nbsp; <label for="make_player_from_link">Links to Audio Files</label></td>
							<td><span class="description">Links within post/page content will be turned into players using the shortcode specified under the 'Advanced' tab.</span></td>
						</tr>
						<tr>
							<td class="mainTick"><input type="checkbox" name="replace_WP_attached" id="replace_WP_attached" value="true" <?php if ($O['replace_WP_attached'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); } ?> /> 
								&nbsp; <label for="replace_WP_attached">Attached Audio</label></td>
							<td><span class="description">Use the shortcode <code>[audio]</code> in posts and pages to playlist any attached audio.</span></td>
						</tr>
						<tr>
							<td class="mainTick"><input type="checkbox" name="replace_WP_embedded" id="replace_WP_embedded" value="true" <?php if ($O['replace_WP_embedded'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); } ?> /> 
								&nbsp; <label for="replace_WP_embedded">URLs</label></td>
							<td><span class="description">Paste urls directly into posts and pages (WP 3.6+).</span></td>
						</tr>
					</table>
					<br>
					<p class="description" style="font-size:14px;">You can always use MP3-jPlayer's own shortcodes and widgets regardless of the above settings.</p>
					
					
					
					
					
					<br><hr><br>
					
					
					
					<p class="description" style="font-size:14px; margin-bottom:10px;">On pages like Index, Archive and Search pages, choose whether players should be seen within the results. These settings won't affect player widgets.</p>
					<p style="font-size:14px; margin-bottom:8px;"><input type="checkbox" name="mp3foxOnBlog" id="mp3foxOnBlog" value="true" <?php if ($O['player_onblog'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); }?> />
						<label for="mp3foxOnBlog"> &nbsp; Show players when the full content is used.</p>
					<p style="font-size:14px; margin-bottom:8px;"><input type="checkbox" name="runShcodeInExcerpt" id="runShcodeInExcerpt" value="true" <?php if ($O['run_shcode_in_excerpt'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); }?> />
						<label for="runShcodeInExcerpt"> &nbsp; Show players when excerpts (short summaries) are used.</label></p>
					
					<p class="description" style="margin:0 0 10px 30px; font-size:14px;">NOTE: You will need to manually write your post excerpts for this to work. Write your shortcodes into the excerpt field on post edit screens.</p>
					
					
					
					
					
					<br><hr><br>
					
					
					
					<h3 style="margin:0 0 20px 0; font-weight:500;">Conversion Options</h3>
					<table>
						<tr>
							<td class="padB" style="font-size:14px;"><strong>Turn</strong> <code>[audio]</code> <strong>shortcodes into</strong>:</td>
							<td class="padB">
								<select name="replacerShortcode_single" style="width:200px; font-weight:500;">
									<option value="mp3j"<?php if ( 'mp3j' == $O['replacerShortcode_single'] ) { echo ' selected="selected"'; } ?>>Single Players - Graphic</option>
									<option value="mp3t"<?php if ( 'mp3t' == $O['replacerShortcode_single'] ) { echo ' selected="selected"'; } ?>>Single Players - Text</option>
									<option value="player"<?php if ( 'player' == $O['replacerShortcode_single'] ) { echo ' selected="selected"'; } ?>>Playlist Players</option>
									<option value="popout"<?php if ( 'popout' == $O['replacerShortcode_single'] ) {  echo ' selected="selected"'; } ?>>Popout Links</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="padB" style="font-size:14px;"><strong>Turn</strong> <code>[playlist]</code> <strong>shortcodes into</strong>:&nbsp;&nbsp;&nbsp;</td>
							<td class="padB">
								<select name="replacerShortcode_playlist" id="replacerShortcode_playlist" style="width:200px; font-weight:500;">
									<option value="player"<?php if ( 'player' == $O['replacerShortcode_playlist'] ) { echo ' selected="selected"'; } ?>>Playlist Players</option>
									<option value="popout"<?php if ( 'popout' == $O['replacerShortcode_playlist'] ) {  echo ' selected="selected"'; } ?>>Popout Links</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="vTop padB" style="font-size:14px;"><strong>Turn converted links into</strong>:</td>
							<td class="padB">
								<textarea class="widefat" style="width:400px; height:100px;" name="make_player_from_link_shcode"><?php 
									$deslashed = str_replace('\"', '"', $O['make_player_from_link_shcode'] );
									echo $deslashed; 
									?></textarea><br />
								<p class="description" style="margin:5px 0 10px 0; font-size:14px;">Placeholders: <code>{TEXT}</code> - Link text, <code>{URL}</code> - Link url.
									<br />This field can also include arbitrary text/html.</p>
							</td>
						</tr>
					</table>							
					<hr><br>
					
					
					<h3 style="margin:0 0 20px 0; font-weight:500;">Misc File Settings</h3>
					<p class="mainTick"><input type="checkbox" name="allowRangeRequests" id="allowRangeRequests" value="true"<?php echo ( $O['allowRangeRequests'] === "true" ? ' checked="checked"' : ''); ?>/><label for="allowRangeRequests">&nbsp;&nbsp; Allow position seeking beyond buffered</label></p>
					<p class="description" style="margin:0 0 10px 30px; max-width:550px; font-size:14px;">Lets users seek to end of tracks without waiting for media to load. Most servers 
						should allow this by default, if you are having issues then check that your server has the <code>accept-ranges: bytes</code> header set, or 
						you can just switch this option off.</p>
					<p class="mainTick" style="margin:0 0 10px 0px;"><input type="checkbox" id="mp3foxHideExtension" name="mp3foxHideExtension" value="true" <?php if ($O['hide_mp3extension'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); }?> /> &nbsp; <label for="mp3foxHideExtension">Hide file extensions if a filename is displayed</label><br /><span class="description" style="margin-left:30px; font-size:14px;">Filenames are displayed when there's no available titles.</span></p>
					<p class="mainTick" style="margin:0 0 10px 0px;"><input type="checkbox" id="mp3foxEncodeFiles" name="mp3foxEncodeFiles" value="true" <?php if ($O['encode_files'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); }?> /> &nbsp; <label for="mp3foxEncodeFiles">Encode URLs</label><br /><span class="description" style="margin-left:30px;font-size:14px;">Provides some obfuscation of your urls in the page source.</span></p>
					<p class="mainTick" style="margin:0 0 10px 0px;"><input type="checkbox" id="mp3foxAllowRemote" name="mp3foxAllowRemote" value="true" <?php if ($O['allow_remoteMp3'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); }?> /> &nbsp; <label for="mp3foxAllowRemote">Allow playing of off-site files</label><br /><span class="description" style="margin-left:30px;font-size:14px;">Un-checking this option filters out any files coming from other domains, but doesn't affect ability to play from a remote default path if one has been set above.</span></p>					
					<br><hr><br>
					
					
					
					<h3 style="margin:0 0 20px 0; font-weight:500;">Misc Player Settings</h3>				
					<p class="mainTick" style="margin-bottom:10px;"><strong>Show player error messages</strong>:
						&nbsp;&nbsp;&nbsp;
						<select name="showErrors">
							<option value="false"<?php if ( 'false' == $O['showErrors'] ) { echo ' selected="selected"'; } ?>>Never</option>
							<option value="admin"<?php if ( 'admin' == $O['showErrors'] ) { echo ' selected="selected"'; } ?>>To Admins only</option>
							<option value="true"<?php if ( 'true' == $O['showErrors'] ) { echo ' selected="selected"'; } ?>>To All</option>
						</select></p>
					<br><hr><br>
					
					
					
					<h3 style="margin:0 0 20px 0; font-weight:500;">Playlist Separator Settings</h3>
					<div style="margin: 10px 0px 10px 0px; padding:6px 18px 6px 18px; background:#f9f9f9; border:1px solid #ccc;">
						<p><span class="description" style="font-size:14px;">If you manually write playlists then you can choose the separators you use in the tracks and captions lists. 
							<br /><span style="color:#333;">CAUTION!!</span> You'll need to manually update any existing playlists if you change the separators!</span></p>
						
						<p class="mainTick" style="margin:10px 0 0 20px;"><strong>Files:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<select name="file_separator" style="width:120px; font-size:11px; line-height:16px;">
								<option value="," <?php if ( ',' == $O['f_separator'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>, (comma)</option>
								<option value=";" <?php if ( ';' == $O['f_separator'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>; (semicolon)</option>
								<option value="###" <?php if ( '###' == $O['f_separator'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>### (3 hashes)</option>
							</select>
							&nbsp;&nbsp;<span class="description">eg.</span> <code>tracks="fileA.mp3 <?php echo $O['f_separator']; ?> Title@fileB.mp3 <?php echo $O['f_separator']; ?> fileC.mp3"</code></p>
						
						<p class="mainTick" style="margin-left:20px;"><strong>Captions:</strong> &nbsp;&nbsp; 
							<select name="caption_separator" style="width:120px; font-size:11px; line-height:16px;">
								<option value="," <?php if ( ',' == $O['c_separator'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>, (comma)</option>
								<option value=";" <?php if ( ';' == $O['c_separator'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>; (semicolon)</option>
								<option value="###" <?php if ( '###' == $O['c_separator'] ) { _e('selected="selected"', $MP3JP->textdomain ); } ?>>### (3 hashes)</option>
							</select>
							&nbsp;&nbsp;<span class="description">eg.</span> <code>captions="Caption A <?php echo $O['c_separator']; ?> Caption B <?php echo $O['c_separator']; ?> Caption C"</code></p>
					</div>
					
					
				
					
					<br><hr><br>
					
					
					
					
					<h3 style="margin:0 0 20px 0; font-weight:500;">Developer Settings</h3>
					<p class="mainTick"><input type="checkbox" id="mp3foxEchoDebug" name="mp3foxEchoDebug" value="true" <?php if ($O['echo_debug'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); }?> /> 
						&nbsp;<label for="mp3foxEchoDebug">Turn on debug</label>
						<br />&nbsp; &nbsp; &nbsp; &nbsp;<span class="description" style="font-size:14px;">Info appears in the source view near the bottom.</span></p>
					
					
					<?php $bgc = ( $O['disable_jquery_libs'] == "yes" ) ? "#fdd" : "#f9f9f9"; ?>
					<div style="margin: 20px 0px 10px 0px; padding:6px; background:<?php echo $bgc; ?>; border:1px solid #ccc;">
						<p class="mainTick" style="margin:0 0 5px 18px; font-weight:700;">Disable jQuery and jQuery-UI javascript libraries? &nbsp; <input type="text" style="width:60px;" name="disableJSlibs" value="<?php echo $O['disable_jquery_libs']; ?>" /></p>
						<p style="margin: 0 0 8px 18px;"><span class="description" style="font-size:14px;"><span style="color:#333;">CAUTION!!</span> This option will bypass the request <strong>from this plugin only</strong> for both jQuery <strong>and</strong> jQuery-UI scripts,
							you <strong>MUST</strong> be providing these scripts from an alternative source.
							<br />Type <code>yes</code> in the box and save settings to bypass jQuery and jQuery-UI.</span></p>
					</div>
					
					
					
				</div><!-- CLOSE ADVANCED TAB -->
			
			
			</div><!-- close tabs wrapper -->
			
			
			
			<hr /><br />
			<table>
				<tr>
					<td>
						<input type="submit" name="update_mp3foxSettings" class="button-primary" style="font-weight:700;" value="<?php _e('Save All Changes', $MP3JP->textdomain ) ?>" />&nbsp;&nbsp;&nbsp;
					</td>
					<td>
						 <p style="margin-top:5px;"><label for="mp3foxRemember">Remember settings if plugin is deactivated &nbsp;</label>
							<input type="checkbox" id="mp3foxRemember" name="mp3foxRemember" value="true" <?php if ($O['remember_settings'] == "true") { _e('checked="checked"', $MP3JP->textdomain ); }?> /></p>
					</td>
				<tr>
			</table>

			<input type="hidden" name="mp3foxPluginVersion" value="<?php echo $MP3JP->version_of_plugin; ?>" />
		
		</form>
		<br>
		<hr>
		<div style="margin: 15px 0px 0px 0px; min-height:30px;">
			<p class="description" style="margin: 0px 120px px 0px; font-weight:700; color:#d0d0d0;">
				<a class="button-secondary" target="_blank" href="http://mp3-jplayer.com/help-docs/">Help & Docs &raquo;</a>
				&nbsp;&nbsp; <a class="button-secondary" target="_blank" href="http://mp3-jplayer.com/add-ons">Get Add-Ons &raquo;</a>
				&nbsp;&nbsp; <a class="button-secondary" target="_blank" href="http://mp3-jplayer.com/skins">Get Skins &raquo;</a>
			</p>
		</div>
		
		
		<div style="margin: 15px auto; height:100px;">
		</div>
	</div>

<?php
	
}
?>