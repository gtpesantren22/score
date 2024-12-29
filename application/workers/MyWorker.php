<?php
require_once __DIR__ . '/../index.php'; // Bootstrap CI3

$CI = &get_instance();
$CI->load->model('Job_model'); // Pastikan model tersedia

echo "Worker started\n";

while (true) {
    $jobs = $CI->Job_model->get_pending_jobs();
    foreach ($jobs as $job) {
        echo "Processing job: {$job->id}\n";
        $CI->Job_model->mark_as_processing($job->id);

        try {
            $data = json_decode($job->job_data, true);
            echo "Job data: " . print_r($data, true) . "\n";

            $CI->Job_model->mark_as_completed($job->id);
        } catch (Exception $e) {
            echo "Error processing job {$job->id}: " . $e->getMessage() . "\n";
            $CI->Job_model->mark_as_failed($job->id);
        }
    }
    sleep(5); // Tunggu sebelum memeriksa ulang
}
