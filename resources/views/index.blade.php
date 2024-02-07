<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/9d17737383.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Padang Eye Center</title>
</head>

<style>
    h1 {
        color: white;
    }

    h2 {
        color: white;
    }

    h5 {
        color: #3498db;
    }

    body {
        margin: 0;
        font-family: 'Arial', sans-serif;
        background: linear-gradient(to right, #3498db, #2c3e50);

    }

    @-webkit-keyframes blinker {
        from {
            opacity: 1.0;
        }

        to {
            opacity: 0.0;
        }
    }

    .shine {
        font-size: 50px;
        text-transform: uppercase;
        line-height: 1;
        text-align: center;
        background: linear-gradient(90deg, rgba(52, 152, 219, 1) 0%, rgba(255, 255, 255) 20%, rgba(52, 152, 219, 1) 39%, rgba(255, 255, 255) 50%, rgba(52, 152, 219, 1) 60%, rgba(255, 255, 255) 80%, rgba(52, 152, 219, 1) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: shine 4s infinite;
        background-size: 200%;
        background-position: left;
    }

    @keyframes shine {
        to {
            background-position: right;
        }
    }


    .blink {
        text-decoration: blink;
        -webkit-animation-name: blinker;
        -webkit-animation-duration: 0.6s;
        -webkit-animation-iteration-count: infinite;
        -webkit-animation-timing-function: ease-in-out;
        -webkit-animation-direction: alternate;
    }
</style>

<body>
    <div class="container">
        <div class="row " style="margin-top: 40vh">
            <div class="col text-center">
                <h1 class="text-center shine">Padang Eye Center</h1>
                {{-- <h2 class="text-center ">Masukan Nama Anda</h2> --}}
                <div class="input-group mb-3">
                    <button onclick="search()" class="btn btn-primary" type="button" id="button-addon1"
                        type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    <input type="text" id="searchInput" class="form-control shadow" placeholder="Masukan nama anda"
                        aria-label="Example text with button addon" aria-describedby="button-addon1">
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-6 mx-auto text-center" id="spin">


            </div>
        </div>
        <div class="row" id="hasilPencarian">


        </div>

    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('/js/jquery-3.7.1.min.js') }}"></script>
    <script>
        function search() {
            var name = $('#searchInput').val()
            console.log(name.length)
            if (name.length > 0) {
                $('#spin').html(`<i class="fa fa-spinner fa-pulse fa-3x fa-fw text-white"></i>`)
                $.ajax({
                    url: `/data-karyawan/${name}`,
                    type: "GET",
                    success: function(data) {
                        console.log(data)
                        $('#spin').html('')
                        if (data.length > 0) {
                            let result = ''
                            data.forEach(element => {
                                let {
                                    name,
                                    bis,
                                    resort,
                                    koordinator,
                                } = element
                                result += `
                            <div class="col d-flex justify-content-center align-items-center m-2">
                                <div class="card shadow-sm" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">${name}</h5>
                                        <div>
                                            <table class="table table-responsive">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            Bis
                                                        </td>
                                                        <td>
                                                            ${bis}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Resort
                                                        </td>
                                                        <td>
                                                            ${resort}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Koordinator
                                                        </td>
                                                        <td>
                                                            ${koordinator}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>`
                            });

                            $('#hasilPencarian').html(result)
                        } else {
                            $('#hasilPencarian').html(
                                `<p style="color:white;">Data Tidak ditemukan, Mohon perhatikan penulisannya!</p>`
                            )
                        }

                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                Swal.fire({
                    title: "Mohon masukan nama anda!",
                    width: 600,
                    padding: "3em",
                    color: "#716add",
                    background: "#fff url(/gif/trees.png)",
                    backdrop: `
                            rgba(0,0,123,0.4)
                            url("/gif/1.gif")
                            left top
                            no-repeat
                        `
                });
            }

        }
    </script>

</body>

</html>
