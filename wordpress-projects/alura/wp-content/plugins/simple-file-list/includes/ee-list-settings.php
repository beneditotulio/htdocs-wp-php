<?php // Simple File List Script: ee-list-settings.php | Author: Mitchell Bennis | support@simplefilelist.com
	
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( ! wp_verify_nonce( $eeSFL_Nonce, 'eeInclude' ) ) exit('ERROR 98'); // Exit if nonce fails

$eeSFL_Log[] = 'Loading List Settings Page ...';

// Check for POST and Nonce
if(@$_POST['eePost'] AND check_admin_referer( 'ee-simple-file-list-settings', 'ee-simple-file-list-settings-nonce')) {
	
	// Get all the settings
	$eeSettings = get_option('eeSFL-Settings');
	
	if($_POST['eeShowList'] == 'YES') { $eeSettings[$eeSFL_ID]['ShowList'] = 'YES'; } 
			elseif($_POST['eeShowList'] == 'USER') { $eeSettings[$eeSFL_ID]['ShowList'] = 'USER'; } // Show only to logged in users
			 elseif($_POST['eeShowList'] == 'ADMIN') { $eeSettings[$eeSFL_ID]['ShowList'] = 'ADMIN'; } // Show only to logged in Admins
				else { $eeSettings[$eeSFL_ID]['ShowList'] = 'NO'; }	
			
	if($eeSFL_Config['ShowList'] != 'NO') { // Only update if showing the list
		
		// YES/NO Checkboxes
		$eeCheckboxes = array(
			'ShowFileThumb'
			,'ShowFileDate'
			,'ShowFileSize'
		);
		
		foreach( $eeCheckboxes as $eeTerm){ // "ee" is added in the function
			
			$eeSettings[$eeSFL_ID][$eeTerm] = eeSFL_ProcessCheckboxInput($eeTerm);
		}
		
		$eeTextInputs = array(
			'LabelThumb'
			,'LabelName'
			,'LabelDate'
			,'LabelSize'
		);
		foreach( $eeTextInputs as $eeTerm){
			$eeSettings[$eeSFL_ID][$eeTerm] = eeSFL_ProcessTextInput($eeTerm);
		}
		
		// Sort by Select Box	
		if(@$_POST['eeSortBy']) { 
			
			if($_POST['eeSortBy'] != $eeSettings[$eeSFL_ID]['SortBy']) { // Changed
				
				$eeSettings[$eeSFL_ID]['SortBy'] = sanitize_text_field($_POST['eeSortBy']);
				
			} else { $eeSettings[$eeSFL_ID]['SortBy'] = 'Name'; }
			
		}
		
		// Asc/Desc Checkbox
		if(@$_POST['eeSortOrder'] == 'Descending') { $eeSettings[$eeSFL_ID]['SortOrder'] = 'Descending'; }
			elseif($_POST['eeSortBy'] AND !@$_POST['eeSortOrder']) { $eeSettings[$eeSFL_ID]['SortOrder'] = 'Ascending'; }
		
		// Expiration
		if( is_numeric($_POST['eeExpireTime']) AND $_POST['eeExpireTime'] <= 24 ) { 
			
			if($eeSFL_Config['ExpireTime'] != $_POST['eeExpireTime']) { // Changed
				$eeSettings[$eeSFL_ID]['ExpireTime'] = $_POST['eeExpireTime'];
			}	
		}
	}
	
	// Update DB
	update_option('eeSFL-Settings', $eeSettings );
	
	delete_transient('eeSFL_FileList-' . $eeSFL_ID); // Force a rescan
	
	// Update the array with new values
	$eeSFL_Config = $eeSettings[$eeSFL_ID];
	
	$eeSFL_Confirm = __('List Settings Saved', 'ee-simple-file-list');
}

// Settings Display =========================================
	
$eeOutput .= '<div class="eeSFL_Admin">';
	
if(@$eeSFL_Log['errors']) { 
	$eeOutput .=  eeSFL_ResultsDisplay($eeSFL_Log['errors'], 'notice-error');
} elseif(@$eeSFL_Confirm) { 
	$eeOutput .=  eeSFL_ResultsDisplay($eeSFL_Confirm, 'notice-success');
}

// Begin the Form	
$eeOutput .= '

<form action="' . admin_url() . '?page=' . $eeSFL->eePluginSlug . '&tab=settings&subtab=list_settings" method="post" id="eeSFL_Settings">
		
		<p class="eeSettingsRight"><a class="eeInstructionsLink" href="https://simplefilelist.com/file-list-settings/" target="_blank">' . __('Instructions', 'ee-simple-file-list') . '</a>
		<input type="submit" name="submit" value="' . __('SAVE', 'ee-simple-file-list') . '" class="button eeSFL_Save" /></p>
		
		<h2>' . __('List Settings', 'ee-simple-file-list') . '</h2>
		
		<input type="hidden" name="eePost" value="TRUE" />
		<input type="hidden" name="eeListID" value="' . $eeSFL_ID . '" />';	
		
		$eeOutput .= wp_nonce_field( 'ee-simple-file-list-settings', 'ee-simple-file-list-settings-nonce', TRUE, FALSE);
		
		$eeOutput .= '<fieldset>
	
		<label for="eeShowList">' . __('Front-Side Display', 'ee-simple-file-list-pro') . '</label>
		
		<select name="eeShowList" id="eeShowList">
		
			<option value="YES"';

			if($eeSFL_Config['ShowList'] == 'YES') { $eeOutput .= ' selected'; }
			
			$eeOutput .= '>' . __('Show to Everyone', 'ee-simple-file-list-pro') . '</option>
			
			<option value="USER"';

			if($eeSFL_Config['ShowList'] == 'USER') { $eeOutput .= ' selected'; }
			
			$eeOutput .= '>' . __('Show to Only Logged in Users', 'ee-simple-file-list-pro') . '</option>
			
			<option value="ADMIN"';

			if($eeSFL_Config['ShowList'] == 'ADMIN') { $eeOutput .= ' selected'; }
			
			$eeOutput .= '>' . __('Show to Only Logged in Admins', 'ee-simple-file-list-pro') . '</option>
			
			<option value="NO"';

			if($eeSFL_Config['ShowList'] == 'NO') { $eeOutput .= ' selected'; }
			
			$eeOutput .= '>' . __('Hide the File List Completely', 'ee-simple-file-list-pro') . '</option>
		
		</select>
		
		<br class="eeClearFix" />
		<div class="eeNote">' . __('Determine who you will show the front-side list to.', 'ee-simple-file-list-pro') . '</div> <h3>' . __('Information to Show', 'ee-simple-file-list') . '</h3>
				
				<div class="eeNote">' . __('Limit the file information to display on the front-side file list.', 'ee-simple-file-list') . '</div>

				<table id="eeListSettingsTable">
					<thead>
					  	<tr>
					     	<th>' . __('Item', 'ee-simple-file-list') . '</th>
						 	<th>' . __('Show', 'ee-simple-file-list') . '</th>
						 	<th>' . __('Label', 'ee-simple-file-list') . '</th>
						 </tr>
					</thead>
				<tbody>
				  
				<tr>
				     <td>' . __('File Thumbnail', 'ee-simple-file-list') . '</td>
				     <td><input type="checkbox" name="eeShowFileThumb" value="YES" id="eeShowFileThumb"'; 
				if($eeSFL_Config['ShowFileThumb'] == 'YES') { $eeOutput .= ' checked'; }
				$eeOutput .= ' /></td>
				     <td><input type="text" name="eeLabelThumb" value="';
				if(@$eeSFL_Config['LabelThumb']) { $eeOutput .= stripslashes($eeSFL_Config['LabelThumb']); } else { $eeOutput .= __('Thumb', 'ee-simple-file-list'); }
				$eeOutput .= '" size="16" /></td>
				  </tr>
				  
				  <tr>
				     <td>' . __('File Name', 'ee-simple-file-list') . '</td>
				     <td><input type="checkbox" name="eeShowFileName" value="YES" id="eeLabelName" checked="checked" disabled /></td>
				     <td><input type="text" name="eeLabelName" value="';
				if(@$eeSFL_Config['LabelName']) { $eeOutput .= stripslashes($eeSFL_Config['LabelName']); } else { $eeOutput .= __('Name', 'ee-simple-file-list'); }
				$eeOutput .= '" size="16" /></td>
				  </tr>
				  
				  <tr>
				     <td>' . __('File Date', 'ee-simple-file-list') . '</td>
				     <td><input type="checkbox" name="eeShowFileDate" value="YES" id="eeShowFileDate"'; 
				if($eeSFL_Config['ShowFileDate'] == 'YES') { $eeOutput .= ' checked'; }
				$eeOutput .= ' /></td>
				     <td><input type="text" name="eeLabelDate" value="';
				if(@$eeSFL_Config['LabelDate']) { $eeOutput .= stripslashes($eeSFL_Config['LabelDate']); } else { $eeOutput .= __('Date', 'ee-simple-file-list'); }
				$eeOutput .= '" size="16" /></td>
				  </tr>
				  
				  <tr>
				     <td>' . __('File Size', 'ee-simple-file-list') . '</td>
				     <td><input type="checkbox" name="eeShowFileSize" value="YES" id="eeShowFileSize"'; 
				if($eeSFL_Config['ShowFileSize'] == 'YES') { $eeOutput .= ' checked'; }
				$eeOutput .= ' /></td>
				     <td><input type="text" name="eeLabelSize" value="';
				if(@$eeSFL_Config['LabelSize']) { $eeOutput .= stripslashes($eeSFL_Config['LabelSize']); } else { $eeOutput .= __('Size', 'ee-simple-file-list'); }
				$eeOutput .= '" size="16" /></td>
				  </tr>
				 
				 
				  	</tbody>
				</table>
				
				
				<br class="eeClearFix" />';
				
				$eeOutput .= '
					
				<br class="eeClearFix" />
				
				<h3>' . __('File Sorting and Order', 'ee-simple-file-list') . '</h3>	
				
				<label for="eeSortList">' . __('Sort By', 'ee-simple-file-list') . ':</label>
				
				<select name="eeSortBy" id="eeSortList">
				
						<option value="Name"';
						
						if($eeSFL_Config['SortBy'] == 'Name') { $eeOutput .=  ' selected'; }
						
						$eeOutput .= '>' . __('File Name', 'ee-simple-file-list') . '</option>
						<option value="Date"';
						
						if($eeSFL_Config['SortBy'] == 'Date') { $eeOutput .=  ' selected'; }
						
						$eeOutput .= '>' . __('File Date', 'ee-simple-file-list') . '</option>
						<option value="Size"';
						
						if($eeSFL_Config['SortBy'] == 'Size') { $eeOutput .=  ' selected'; }
						
						$eeOutput .= '>' . __('File Size', 'ee-simple-file-list') . '</option>
						<option value="Random"';
						
						if($eeSFL_Config['SortBy'] == 'Random') { $eeOutput .=  ' selected'; }
						
						$eeOutput .= '>' . __('Random', 'ee-simple-file-list') . '</option>
					
					</select> 
				
				<div class="eeNote">' . __('Sort the list by name, date, file size, or randomly.', 'ee-simple-file-list') . '</div>
					
				<br class="eeClearFix" />
					
				<label for="eeSortOrder">' . __('Reverse Order', 'ee-simple-file-list') . ':</label>
				<input type="checkbox" name="eeSortOrder" value="Descending" id="eeSortOrder"';
				
				if( $eeSFL_Config['SortOrder'] == 'Descending') { $eeOutput .= ' checked="checked"'; }
				
				$eeOutput .= ' /> <p>&darr; ' . __('Descending', 'ee-simple-file-list') . '</p>
				
				<div class="eeNote">' . __('Check this box to reverse the default sort order.', 'ee-simple-file-list') . '<br />
					' . __('The list is sorted Ascending by default', 'ee-simple-file-list') . ': A to Z, ' . __('Small to Large', 'ee-simple-file-list') . ', ' . __('Old to New', 'ee-simple-file-list') . '</div>
					
				<br class="eeClearFix" />
				
				<h2>' . __('File List Performance', 'ee-simple-file-list') . '</h2>	
				
				<label for="eeExpireTime">' . __('Re-Scan Interval', 'ee-simple-file-list') . ':</label>
				<input type="range" id="eeExpireTime" name="eeExpireTime" min="0" max="24" step="1" value="' . $eeSFL_Config['ExpireTime'] . '" /> 
					<p><span id="eeExpireTimeValue">' . $eeSFL_Config['ExpireTime'] . '</span> ' . __('Hours', 'ee-simple-file-list') . '</p>
					<div class="eeNote">' . __('Choose how often the file list on your disc drive is re-scanned.', 'ee-simple-file-list') . ' ' .  
						__('Set to zero to re-scan on each list page load.', 'ee-simple-file-list') . '<br />
					<em>' . __('If you use FTP or another method to upload files to your list, set the interval to zero.', 'ee-simple-file-list') . '</em></div>';		
			
			
		$eeOutput .= '<br class="eeClearFix" />
		
		<input type="submit" name="submit" value="' . __('SAVE', 'ee-simple-file-list') . '" class="button eeSFL_Save" />
		
		</fieldset>
		
	</form>
	
</div>';
	
?>