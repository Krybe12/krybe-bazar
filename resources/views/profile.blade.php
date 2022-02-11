@extends('layout')
@section('title') {{ $titleText }} @endsection

@section('content')
  <div class="d-flex flex-column align-items-center justify-content-center py-4">
    <div class="col">
      <h1 class="pb-md-4 pb-2"><b> Profile of {{ $user->user_name }} </b></h1>
    </div>

    <div class="col d-flex flex-column rounded-3 p-4">
      <nav class="d-flex justify-content-center">
        <div class="nav nav-tabs pb-1" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-information-tab" data-bs-toggle="tab" data-bs-target="#nav-information" type="button" role="tab" aria-controls="nav-information-tab" aria-selected="true">Information</button>
          <button class="nav-link" id="nav-offers-tab" data-bs-toggle="tab" data-bs-target="#nav-offers" type="button" role="tab" aria-controls="nav-offers" aria-selected="false">Offers</button>
        </div>
      </nav>
      <div class="tab-content border shadow bg-white rounded-3" id="nav-tabContent" style="min-width: 65vw; width: 92vw; min-width: 330px; max-width: 650px;">

        <div class="tab-pane fade show active m-4" id="nav-information" role="tabpanel" aria-labelledby="nav-information-tab" style="min-height: 100px;">
          
          @if (Auth::check() && Auth::id() === $user->id)
            <a class="btn btn-primary mb-4" href="/addinformation" > Change/Add your information </a>
          @endif

          <div class="d-flex row">
            <div class="col">
              <h4>Contact</h4>
            </div>

            <div class="col-auto flex-column d-flex align-items-start">
              <table class="table table-borderless table-responsive">
                <tbody>
                  <tr>
                    <td class="text-nowrap"><i class="bi bi-person-fill"></i> Username: </td>
                    <td class="text-wrap"> {{ $user->user_name }}</td>
                  </tr>

                  @if ($user->name != "null")
                    <tr>
                      <td class="text-nowrap"><i class="bi bi-person"></i> Name: </td>
                      <td class="text-wrap"> {{ $user->name }}</td>
                    </tr>
                  @endif

                  @if ($user->email != "null")
                    <tr>
                      <td class="text-nowrap"><i class="bi bi-at"></i> Email: </td>
                      <td class="text-wrap"> <a href="mailto:{{ $user->email }}" style="color: blue"> {{ $user->email }} </a></td>
                    </tr>
                  @endif

                  @if ($user->phone_number != "null")
                    <tr>
                      <td class="text-nowrap"><i class="bi bi-phone"></i> Telephone: </td>
                      <td class="text-wrap"> <a href="tel:{{ $user->phone_number }}" style="color: blue"> {{ $user->phone_number }} </a></td>
                    </tr>
                  @endif
                </tbody>
              </table>
          
            </div>
          </div>
        </div>

        <div class="tab-pane fade m-4" id="nav-offers" role="tabpanel" aria-labelledby="nav-offers-tab" style="min-height: 100px">

        </div>

      </div>
    </div>
  </div>
  <script>
    let userId = {{ $user->id }}
    getData(1);
    async function getData(page){
      let url = `/offers?page=${page}&user=${userId}`;
      await fetch(url)
        .then(response => response.text())
        .then(data => document.getElementById('nav-offers').innerHTML = data);
      setPaginationEventListeners()
    }

    async function setPaginationEventListeners(){
      document.querySelectorAll('.pagination a').forEach(el => {
        el.addEventListener("click", (e) => {
          e.preventDefault();
          getData(el.href.split("page=")[1])
        });
      })
    }
  </script>
@endsection