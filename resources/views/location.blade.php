<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container m-5">
        <div class="alert alert-info">
            Google Map Api
        </div>
        <form>
            <div class="mb-3">
                <label for="address-input" class="form-label">Search Address, City or Country</label>
                <input type="text" class="form-control map-input" id="address-input">
            </div>


            <hr>
            <div>
                <div id="address-map-container" style="width:100%; height:400px">
                    <div style="width:100%; height:100%;" id="address-map"></div>

                </div>
            </div>
            <hr>
            <div class="mb-3">
                <label for="address-latitude" class="form-label">Latitude</label>
                <input type="text" class="form-control" id="address-latitude">
            </div>
            <div class="mb-3">
                <label for="address-longitude" class="form-label">Longitude</label>
                <input type="text" class="form-control" id="address-longitude">
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBY5p5e5PtJuJLl_nRpjefL0S094jdhEP8&libraries=places&callback=initialize"
        async defer></script>
    <script type="text/javascript" src="{{ config('app.url') }}/Frontend/MyJs/mapInput.js"></script>
</body>

</html>
