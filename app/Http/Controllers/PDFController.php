<!-- 

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function exportPDF()
    {
        // Ambil data dari API backend
        $response = Http::get('http://localhost:8080/Absensi');
        $absensi = $response->json();

        //  dd($absensi);
        // Pastikan respons adalah array
        $absen = collect($absensi);

        // Generate PDF
        $pdf = Pdf::loadView('pdf.pdf-absensi', ['absensi' => $absen]);
        return $pdf->download('daftar-hadir.pdf');
    }
} -->
