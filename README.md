Set databse in .env file
    DB_DATABASE=db_seeder_faker

Make migration
    php artisan make:migration add_deleted_at_to_customers_table

Open migration file, add below  code
    Schema::table('customers', function (Blueprint $table) {
        $table->softDeletes();
    });

Run
    php artisan migrate     //Check customer table to verify deleted_at column

Use SoftDeletes Trait in customers Model
    use Illuminate\Database\Eloquent\SoftDeletes;

    class customers extends Model
    {
        use HasFactory;
        use SoftDeletes;
    }

Define route
    Route::get('/customers/delete/{id}', [CustomersController::class, 'destroy'])->name('customers.delete');

Call Route in blade file
    <a href="{{ route('customers.delete', $customer->id) }}" class="btn btn-sm btn-danger">Trash</a>

Define destroy function in Customer Controller
    public function destroy($id)
    {
        $customer = Customers::findOrFail($id);
        $customer->delete();
        return redirect()->back()->with('success', 'Customer deleted successfully.');
    }

Get Trashed Record
Set route
    Route::get('/customers/trashed', [CustomersController::class, 'trashed'])->name('customers.trashed');

Define trashed function to get trashed records
    public function trashed()
    {
        $customers = Customers::onlyTrashed()->get();
        return view('trashed', compact('customers'));
    }

Create blade file to show trashed records
    To permanently delete
    <a href="{{ route('customers.delete', $customer->id) }}" class="btn btn-sm btn-danger">Delete</a>

    Define route to permanently delete
    Route::get('/customers/delete/{id}', [CustomersController::class, 'delete'])->name('customers.delete');

define delete function to delete trashed records 
    
    public function delete($id)
    {
        $customer = Customers::onlyTrashed()->findOrFail($id);
        $customer->forceDelete();
        return redirect()->back()->with('success', 'Customer permanently deleted successfully.');
    }

    To Restore Record
    <a href="{{ route('customers.restore', $customer->id) }}" class="btn btn-sm btn-success">Restore</a>

    Set route to restore records
    Route::get('/customers/restore/{id}', [CustomersController::class, 'restore'])->name('customers.restore');

    define in Controller

    public function restore($id)
    {
        $customer = Customers::onlyTrashed()->findOrFail($id);
        $customer->restore();
        return redirect()->back()->with('success', 'Customer restored successfully.');
    }