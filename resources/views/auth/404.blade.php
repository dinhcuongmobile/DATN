@extends('client.layout.main')

@section('container')
    <section class="section-b-space pt-0">
        <div class="custom-container container error-img">
            <div class="row g-4">
                <div class="col-12 px-0"> <a href="#"><img class="img-fluid" src="../assets/images/other-img/404.png"
                            alt=""></a></div>
                <div class="col-12">
                    <h2>Page Not Found</h2>
                    <p>The page you are looking for doesn't exist or an other error occurred. Go back, or head over to
                        choose a new direction. </p><a class="btn btn_black rounded" href="{{ route('trang-chu.home') }}">Quay lại trang chủ</a>
                </div>
            </div>
        </div>
    </section>
@endsection
