<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Threads Pages</title>
</head>
<body>

    <section>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Threads Page</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Threads</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Profile</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">New Threads</a>
                    </li>

                </ul>

                <a class="navbar-brand" href="#">{{ $user->name }}</a>

                <form class="d-flex" method="post" action="{{ route('logout') }}" role="search">
                    @csrf
                  <button class="btn btn-outline-danger" type="submit">Logout</button>
                </form>
              </div>
            </div>
          </nav>
    </section>


    <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center" bis_skin_checked="1">
        <div class=" w-auto list-group" bis_skin_checked="1">
          <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
            <img src="https://cdn-icons-png.flaticon.com/512/5987/5987424.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
            <div class="d-flex gap-2 w-100 align-items-center justify-content-between" bis_skin_checked="1">
              <div bis_skin_checked="1">
                <h6 class="mb-0"> <i class="fa-regular fa-user"></i> {{ $user->name }}
                    | <i class="fa-regular fa-envelope"></i> {{ $user->email }}
                    | <i class="fa-regular fa-map"></i> {{ $user->profile->city }}, {{ $user->profile->country }}
                    | <i class="fa-regular fa-calendar"></i> {{ $user->profile->age }} Years old</h6>
              </div>
            </div>
          </a>

        </div>
      </div>




    <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center" bis_skin_checked="1">
        <div class="list-group" bis_skin_checked="1">
            @foreach ($threadsPagination as  $thread)

          <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
            <img src="https://upload.wikimedia.org/wikipedia/commons/d/db/Threads_%28app%29.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
            <div class="d-flex gap-2 w-100 justify-content-between" bis_skin_checked="1">
              <div bis_skin_checked="1">
                <h6 class="mb-0">{{ $thread->user->name }} - {{ $thread->formateFollowres }} Followers</h6>
                <h6 class="mb-0">{{ $thread->title }}</h6>
                <p class="mb-0 opacity-75 justify-text">{{ $thread->content }}</p>
                <i class="fa-regular fa-heart"></i> {{ $thread->formateLikes }}
              </div>
              <small class="opacity-50 text-nowrap">{{ $thread->time_ago }}</small>
            </div>
          </a>
          @endforeach


          <nav class="mt-4">
            <ul class="pagination justify-content-end">
                {{ $threadsPagination->links() }}
            </ul>
          </nav>

        </div>
      </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
