<li class="list-group-item">
	<table>
		<tr>
			<td>
				<img class="tweetcik-user-image" src="<?php echo getUserPicturePath($tweetcik->username); ?>" alt="User Image">
			</td>
			<td>
				<p class="tweetcik-user">@<?php echo $tweetcik->username; ?></p>
				<p><?php echo $tweetcik->content; ?></p>
				<p class="tweetcik-date"><?php echo $tweetcik->tweetcikDate; ?></p>
			</td>
		</tr>
	</table>
</li>