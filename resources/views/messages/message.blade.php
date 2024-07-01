@if (session()->has('success') || session()->has('error'))
    <div class="container-fluid p-0">
        <div class="mt-2">
            @if (session()->has('success'))
                <div
                    class="alert cascade-success-alert alert-dismissible fade show"
                    role="alert"
                >
                    <span class="complete_endorsement">{{ session('success') }}</span>
                    <button
                        class="btn-close"
                        type="button"
                        data-bs-dismiss="alert"
                        aria-label="Close"
                    ></button>
                </div>
            @endif
            @if(session()->has('error'))
                <div
                    class="alert cascade-error-alert alert-dismissible fade show"
                    role="alert"
                >
                    <span class="complete_endorsement">{{ session('error') }}</span>
                    <button
                        class="btn-close"
                        type="button"
                        data-bs-dismiss="alert"
                        aria-label="Close"
                    ></button>
                </div>
            @endif
        </div>
    </div>
@endif

