<div class="row">
    <div class="col-lg-12">
        <h2>Settings</h2>
<<<<<<< HEAD

        <div class="card border border-danger mt-5">
            <div class="card-header bg-danger text-white">
                Delete Your Account
            </div>
            <div class="card-body">
                <p>You can delete your user account from <strong>Quick Ads</strong> easily by clicking the button below.</p>
                <p>Please note that after your account is deleted, you cannot log in using the old username and password.</p>
                <form action="{{ route('user.profile.delete', $user->id) }}" 
                    method="POST" class="d-inline" onsubmit="return confirm('Are you sure that you want to delete your profile?\nThis action is irreversible.\n\nPlease proceed with caution.')">
                    @csrf
                    <button class="btn btn-danger">Delete My Account</button>
                </form>
            </div>
        </div>
=======
        <form action="{{ route('user.profile.delete', $user->id) }}" 
            method="POST" class="d-inline" onsubmit="return confirm('Are you sure that you want to delete your profile?')">
            @csrf
            <button class="btn btn-danger">Delete My Profile</button>
        </form>
>>>>>>> 378766ca4f6f1dfa04b1f942ec9f23af899ad376
    </div>
</div>