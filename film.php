<!-- AIzaSyDH5STT2W72g4xPocc3B-7QWh1vMRznp0s -->
<h2><?= $anime_txt; ?></h2>
<br>
<video controls class="idframe" poster="<?= $list_anime['thumbnail']; ?>">
	<source src="https://www.googleapis.com/drive/v3/files/<?= $list_anime['id']; ?>?key=AIzaSyDH5STT2W72g4xPocc3B-7QWh1vMRznp0s&alt=media" type='video/mp4'/>
    <source src="https://www.googleapis.com/drive/v3/files/<?= $list_anime['id']; ?>?key=AIzaSyDH5STT2W72g4xPocc3B-7QWh1vMRznp0s&alt=media" type='video/webm'/>
</video>