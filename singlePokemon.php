<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="singlePokemon.css">
	<title>Single Pokemon</title>
</head>
<body>
	<div class="single">
	</div>
</body>
<script type="text/javascript">
	let params = (new URL(document.location)).searchParams;
	console.log(document.location);
	console.log(params.get("id"));
	fetch(`https://pokeapi.co/api/v2/pokemon/${params.get("id") ?? 1}`)
	.then(response => response.json())
	.then(single => {
		// console.log(single.name);
		// console.log(single.sprites.front_default);
		var pokemonBox = document.querySelector('.single');
		pokemonBox.innerHTML = "";
		pokemonBox.innerHTML += `
				<div class="single_image">
					<img src="${single.sprites.front_default}">
				</div>
				<div class="single_name">
					<p>${single.name}</p>
				</div>
		`
	});

</script>
</html>
