<div class="users_filter mb-2">
    <form action="{{ route('admin.users.documents.check') }}">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <label for="patientName" class="col-12 col-sm-2 col-form-label">ФИО</label>
                    <input type="text" class="col-12 col-sm-10 form-control" name="patientName" id="patientName">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit"  class="btn btn-primary">Найти</button>
            </div>
        </div>
    </form>
</div>
