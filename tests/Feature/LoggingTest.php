<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class LoggingTest extends TestCase
{

    /**
     * Logging Configuration
     * ● Laravel secara default menggunakan file config/logging.php sebagai konfigurasi untuk logging nya
     * ● Saat kita membuat project, secara default, sudah disediakan banyak sekali konfigurasi yang bisa
     *  kita gunakan, namun yang secara default aktif adalah yang sederhana
     *
     * Logging Channel
     * ● Laravel menyediakan beberapa channel (tujuan) log yang bisa kita gunakan, seperti :
     * ● single, mengirim data log ke single file
     * ● daily, mengirim data log ke single file, namun tiap hari akan di rotate file nya
     * ● slack, mengirim data log ke slack chat
     * ● syslog, mengirim data log ke syslog
     * ● null, tidak mengirim data log kemanapun
     * ● stack, mengirim data log ke beberapa channel sekaligus, default nya hanya mengirim ke channel single
     * ● Secara default, Laravel akan menggunakan channel stack
     *
     * Log Facade
     * ● Untuk melakukan logging di Laravel, kita bisa dengan mudah menggunakan Log Facade
     * ● kita tidak perlu manual membuat Logger Monolog lagi
     * ● https://laravel.com/api/9.x/Illuminate/Support/Facades/Log.html
     */

    public function testLogging(){

        Log::info("Hello Info");
        Log::warning("Hello Warning");
        Log::error("Hello Error");
        Log::critical("Hello Critical");

        self::assertTrue(true);

        /**
         * result:
         * secara default Logging di laravel menggunakan channel 'stack'
         * nanti hasil log akan di buatkan nama file laravel.log.. di directory ../storage/logs/laravel.logs
         *
         * file: laravel.log
         * [2024-05-29 14:07:30] testing.INFO: Hello Info
         * [2024-05-29 14:07:30] testing.WARNING: Hello Warning
         * [2024-05-29 14:07:30] testing.ERROR: Hello Error
         * [2024-05-29 14:07:30] testing.CRITICAL: Hello Critical
 */

    }

}
