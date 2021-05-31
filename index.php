<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="pokedex.css">
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	 <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<title>Pokedex</title>
</head>
<!-- Modal -->

<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="single"></div>
      </div>
    </div>
  </div>
</div>

	<!-- Fim modal -->
<body>

	<div class="main">
		<input type="text" name="quantidade" placeholder="Adicione quantos pokemos deseja...">
		<div class="panel_pokedex">
			<div class="all_pokemons">

			</div>
		</div>
	</div>


</body>

<script type="text/javascript">
	
	window.onload = loadPokemons();

	function loadPokemons(){
		
		var quantidade = 0;

		 if(document.querySelector('[name=quantidade]').value != ""){
			quantidade = document.querySelector('[name=quantidade]').value;
			}else{
				quantidade = 20;
			}


	fetch('https://pokeapi.co/api/v2/pokemon?limit=200&offset=${quantidade}')
	.then(response => response.json())
	.then(allPokemons => {
		var pokemons = [];

			console.log('Total ' + quantidade);

		allPokemons.results.map((val)=>{
			fetch(val.url)
			.then(response => response.json())
			.then(pokemonSingle => {
				console.log(pokemonSingle);
				pokemons.push({name: val.name, image: pokemonSingle.sprites.front_default, id: pokemonSingle.id});
			if(pokemons.length == quantidade){
				var pokemonBox = document.querySelector('.all_pokemons');
				pokemonBox.innerHTML = "";

				pokemons.map((val)=>{
					pokemonBox.innerHTML += `
						<div class="pokemons_single">
						
							<div class="pokemons_single_image">
								<img src="${val.image}" opt="${val.id}" data-toggle="modal" data-target="#exampleModal">
							</div>

							<div class="pokemons_single_name">
								<p>${val.name}</p>
							</div>

						</div>
				`
				});
				addEventClick();
			}
			})
		});
	})
}

	function addEventClick(){
		document.querySelectorAll(".pokemons_single").forEach((items)=>{
			items.addEventListener('click', (item)=>{
				// console.log(item.target.getAttribute('opt'));
				ShowPokemon(item.target.getAttribute('opt'));
			});
		})
	}

	function ShowPokemon(idPokemon){
		console.log("id " + idPokemon);
		if(idPokemon != null){
		
		fetch(`https://pokeapi.co/api/v2/pokemon/${idPokemon ?? 1}`)
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
					<p style="color: #f00">${single.name}</p>
				</div>
		`
	});
		}
	}

	document.querySelector('[name=quantidade]').addEventListener('keyup',(value)=>{
		loadPokemons();
	});

</script>


</html>

