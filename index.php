<!--I, Sechan Bae, 000803348 certify that this material is my original work.
    No other person's work has been used without due acknowledgement-->

<!DOCTYPE html>
<html>
    <head>
        <title>Radio Map</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rellax/1.12.1/rellax.js" integrity="sha512-qk0XupXlge1h9I63+bC7K8850xgWnUjTgSNkfLnsqc7dWdx4031UbKjKs2cuRxsNXymkSjyzSCiryVouU74zkg==" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script>
        </script>
        <style>
            html,
            body {
                height: 100%;
                font-family: sans-serif;
            }
            .row{
                height: 100%;
            }
            #map{
                height: 100%;
                border-left: 1px solid rgba(0,0,0,0.4);
            }
            .container{
                display: flex;
                flex-direction: column;
                margin-top: 10px;
                margin-bottom: 10px;
                width: 100%;
            }
            #message{
                text-align: center;
            }
            .buttons{
                display: flex;
                justify-content: center;
            }
            .buttons button{
                margin:0 5px;
            }
            .buttons #pause-button,#play-button{
                display:none;
            }
            .buttons img{
                cursor: pointer;
            }
            #youtube{
                display:none;
            }
            @media (min-width: 768px) {
            .collapse.dont-collapse-sm {
                display: block;
                height: auto !important;
                visibility: visible;
            }
}
        </style>
    </head>

    <body>
        <div class="row">
            <div class="col-lg-2 container">
                <div class="input-group ml-2">
                        
                    <input type="text" class="form-control" id="filter" placeholder="Filter by Song or Artist">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary  d-lg-none d-md-none" data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-controls="collapse"><img src="menu-icon.png" height="22"></button>  
                    </div>
                </div>
                <div class="collapse dont-collapse-sm" id="collapse">
                    <h3 class="mt-5 ml-4">Choose your anthem for your location</h3>
                    <div class="form-group mt-5 ml-2">
                        <label for="song-name">Song Name</label>
                        <input type="text" class="form-control" id="song-name" placeholder="Enter Song">

                    </div>
                    <div class="form-group mt-5 ml-2">
                        <label for="song-artist">Artist</label>
                        <input type="text" class="form-control" id="song-artist" placeholder="Enter Artist">
                    </div>
                    <div class="buttons mt-5 ml-2">
                        <button id="add-button" class="btn btn-primary">Add/Edit</button>
                        <button id="delete-button" class="btn btn-danger">Delete</button>
                    </div>
                    <div class="mt-5 ml-2" id="message"></div>
                    <div class="buttons mt-5 ml-2">
                        <img id="play-button" src="play-icon.png">
                        <img id="pause-button" src="pause-icon.png">
                    </div>
                    
                    <div id="youtube">
                        <iframe  src=""></iframe>
                    </div>
                    <h4 id="song-title" class="mt-5 ml-5"></h4>
                </div>
            </div>
            <div id="map" class="col-lg-10"></div>
        </div>
    <script type="text/javascript" src="https://www.youtube.com/iframe_api"></script>
    <script src="https://apis.google.com/js/api.js"></script>
    <script src="index.js"></script>
        <script
      src="https://maps.googleapis.com/maps/api/js?key=API_KEY&callback=initMap&libraries=&v=weekly"
      async
    ></script>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </body>
</html>