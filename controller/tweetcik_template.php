<li class="list-group-item">
	<table>
		<tr>
			<td style="text-align: center;">
				<img class="tweetcik-user-image" src="<?php echo getUserPicturePath($tweetcik->username); ?>" alt="User Image">
			</td>
			<?php $isOwnTweetcik = (isset($_SESSION['username']) && !empty($_SESSION['username']) && $_SESSION['username'] == $tweetcik->username) ? "display: visible;" : "display: none;"; ?>
			<form id="<?php echo $tweetcik->id; ?>-delete-form" action="controller/remove_tweetcik.php" method="POST">
				<input type="hidden" name="tweetcik-id" value="<?php echo $tweetcik->id; ?>">
				<a class="tweetcik-remove glyphicon glyphicon-remove" onclick="document.getElementById('<?php echo $tweetcik->id; ?>-delete-form').submit();" style="<?php echo $isOwnTweetcik; ?>"></a>
			</form>
			<td>
				<p class="tweetcik-user">@<?php echo $tweetcik->username; ?></p>
				<p><?php echo $tweetcik->content; ?></p>
				<p class="tweetcik-date"><?php echo $tweetcik->tweetcikDate; ?></p>
			</td>
		</tr>
	</table>
</li>