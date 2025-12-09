<!-- 
namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    
        public function jadwal($id)
    {
        $jadwalTraining = Jadwal::findOrFail($id);
        
        // Load view dari folder pdf/jadwal.blade.php
        $pdf = PDF::loadView('pdf.jadwal', compact('jadwal'));
        
        // Download PDF
        return $pdf->download('jadwal-'.$jadwal->id.'.pdf');
        
        // Atau untuk preview di browser:
        // return $pdf->stream('jadwal-'.$jadwal->id.'.pdf');
    }
} -->
