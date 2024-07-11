@if (session()->has('success'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
              <div class="toast-header">
                <span class="me-2 fs-4"><i class="bi bi-info-circle text-success"></i></span>
                <strong class="me-auto text-success">Success!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body">
                {{session()->get('success')}}
              </div>
            </div>
          </div>
@endif

@if (session()->has('error'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <span class="me-2 fs-4"><i class="bi bi-info-circle text-danger"></i></span>
                    <strong class="me-auto text-danger">Error!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{session()->get('error')}}
                </div>
            </div>
          </div>
@endif