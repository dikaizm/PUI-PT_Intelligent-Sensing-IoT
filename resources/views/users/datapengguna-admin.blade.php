<div class="card-styles">
    <div class="card-style-3 mb-30">
        <div class="card-content">

            <div class="alert-box primary-alert">
                <div class="alert">
                    <p class="text-medium">
                        Sample table page
                    </p>
                </div>
            </div>

            <div class="table-wrapper table-responsive">
                <table class="table striped-table">
                    <thead>
                    <tr>
                        <th><h6>Name</h6></th>
                        <th><h6>Email</h6></th>
                    </tr>
                    <!-- end table row-->
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <p>{{ $user->name }}</p>
                            </td>
                            <td>
                                <p>{{ $user->email }}</p>
                            </td>
                        </tr>
                    @endforeach
                    <!-- end table row -->
                    </tbody>
                </table>
                <!-- end table -->

                {{ $users->links() }}
            </div>

        </div>
    </div>
</div>
