@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show position-fixed top-1 start-50 translate-middle-x mt-5"
        style="z-index: 9999; width:80%;" role="alert" id="flash-message">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-error alert-dismissible fade show position-fixed top-1 start-50 translate-middle-x mt-5"
        style="z-index: 9999; width:80%;" role="alert" id="flash-message">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show text-center mt-5 position-fixed top-1 start-50 translate-middle-x" style="z-index: 9999; width:80%;" role="alert">
        <p>your form cant be sent because you have an error in the form</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
