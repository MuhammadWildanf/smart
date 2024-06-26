<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\capacities;
use App\Models\Car;
use App\Models\colors;
use App\Models\Criterion;
use App\Models\prices;
use App\Models\seats;
use App\Models\SubCriterion;
use Illuminate\Http\Request;

class RecomendationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prices = prices::all();
        $colors = colors::all();
        $capacities = capacities::all();
        $seats = seats::all();

        return view('recomendation.index', compact('prices', 'colors', 'capacities', 'seats'));
    }

    public function calculate(Request $request)
    {
        $hargaId = $request->input('harga');
        $warnaId = $request->input('warna');
        $kapasitasMesinId = $request->input('kapasitas_mesin');
        $jumlahSeatId = $request->input('jumlah_seat');

        Log::info('Form data:', [
            'hargaId' => $hargaId,
            'warnaId' => $warnaId,
            'kapasitasMesinId' => $kapasitasMesinId,
            'jumlahSeatId' => $jumlahSeatId,
        ]);

        // Fetch criteria and sub-criteria data
        $criteria = Criterion::all();
        $subCriteria = SubCriterion::all()->groupBy('criteria_id');

        // Check if no valid sub-criteria ID found
        foreach ($criteria as $criterion) {
            $criterionId = $criterion->id;
            $subCriterionId = $request->input('sub_criteria_' . $criterionId);

            // Skip if no valid sub-criterion ID found
            if (!$subCriterionId || !$subCriteria->has($criterionId)) {
                continue;
            }

            // Access sub-criterion value safely
            $subCriteriaEntry = $subCriteria[$criterionId]->where('id', $subCriterionId)->first();

            if ($subCriteriaEntry) {
                $subCriterionValue = $subCriteriaEntry->nilai;
            } else {
                // Handle the case where no matching sub-criterion ID is found
                // For example, set a default value or throw an error
                $subCriterionValue = 0; // Default value or appropriate handling
            }

            // Perform calculations or further processing with $subCriterionValue
            // Here you can integrate your SMART method calculations

            Log::info("Sub-criterion value for Criterion {$criterion->kode}:", [
                'subCriterionId' => $subCriterionId,
                'nilai' => $subCriterionValue,
            ]);
        }

        // Example code to retrieve cars based on selected criteria
        $query = Car::query();

        if ($hargaId) {
            $query->where('harga_id', $hargaId);
        }

        if ($warnaId) {
            $query->where('warna_id', $warnaId);
        }

        if ($kapasitasMesinId) {
            $query->where('kapasitas_mesin_id', $kapasitasMesinId);
        }

        if ($jumlahSeatId) {
            $query->where('seat_id', $jumlahSeatId);
        }

        $cars = $query->get();

        Log::info('Cars found:', $cars->toArray());

        if ($cars->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No cars found matching the selected criteria.',
            ]);
        }

        // Calculate SMART scores for selected criteria
        $smartScores = $this->calculateSmartScores($hargaId, $warnaId, $kapasitasMesinId, $jumlahSeatId);

        // Calculate overall SMART score
        $overallSmartScore = $this->calculateOverallSmartScore($smartScores);

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved cars based on selected criteria.',
            'cars' => $cars,
            'smartScores' => $smartScores,
            'overallSmartScore' => $overallSmartScore,
        ]);
    }

    /**
     * Calculate SMART scores for selected criteria.
     *
     * @param int $hargaId
     * @param int $warnaId
     * @param int $kapasitasMesinId
     * @param int $jumlahSeatId
     * @return array
     */
    private function calculateSmartScores($hargaId, $warnaId, $kapasitasMesinId, $jumlahSeatId)
    {
        // Fetch criteria and their sub-criteria data
        $criteria = Criterion::all();
        $subCriteria = SubCriterion::all()->groupBy('criteria_id');

        // Initialize array to store SMART scores
        $smartScores = [];

        // Iterate through criteria to calculate SMART scores
        foreach ($criteria as $criterion) {
            $criterionId = $criterion->id;
            $weight = $criterion->weight;
            $jenis = $criterion->jenis;

            // Determine which sub-criterion ID corresponds to current criterion
            switch ($criterionId) {
                case 1: // Harga Mobil
                    $subCriterionId = $hargaId;
                    break;
                case 2: // Jumlah Seat
                    $subCriterionId = $jumlahSeatId;
                    break;
                case 3: // Warna
                    $subCriterionId = $warnaId;
                    break;
                case 4: // Kapasitas Mesin
                    $subCriterionId = $kapasitasMesinId;
                    break;
                default:
                    continue 2; // Skip if no valid sub-criterion ID found
            }

            // Retrieve sub-criterion value
            $subCriterionValue = $subCriteria[$criterionId]->where('id', $subCriterionId)->first();

            // Check if sub-criterion value exists
            if ($subCriterionValue) {
                // Normalize sub-criterion value (if needed)
                $normalizedValue = $subCriterionValue->nilai; // Assuming no normalization required

                // Calculate weighted score
                $weightedScore = $normalizedValue * $weight;

                // Store SMART score for current criterion
                $smartScores[$criterion->kode] = [
                    'weight' => $weight,
                    'jenis' => $jenis,
                    'nilai' => $weightedScore,
                ];
            }else{
                $smartScores[$criterion->kode] = [
                    'weight' => $weight,
                    'jenis' => $jenis,
                    'nilai' => 0,
                ];
            }
        }

        // dd($smartScores);
        return $smartScores;
    }

    /**
     * Calculate overall SMART score based on calculated SMART scores.
     *
     * @param array $smartScores
     * @return float
     */
    private function calculateOverallSmartScore($smartScores)
    {
        $overallSmartScore = 0;

        foreach ($smartScores as $score) {
            $overallSmartScore += $score['nilai'];
        }

        return $overallSmartScore;
    }
}
