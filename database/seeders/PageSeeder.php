<?php

namespace Database\Seeders;

use App\Actions\Page\StorePageAction;
use App\Enums\PageTypeEnum;
use App\Models\Page;
use Exception;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var Page $page */
        $page = StorePageAction::run([
            'type'  => PageTypeEnum::ABOUT_US->value,
            'title' => 'Nyd en enestående rejse af smag',
            'body'  => "Velkommen til dit hyggelige hjørne af komfort, smag og inklusivitet. Vores mødested er mere end blot et sted at spise - det er her, god kaffe møder fællesskab, og hver gæst føler sig hjemme.
Vi er stolte af at tilbyde et indbydende, kørestolsvenligt miljø, komplet med nem adgang til parkering, siddepladser og toiletter designet til alle. Uanset om du kigger ind til en hurtig takeaway, planlægger en familiemiddag eller indhenter brunch med vennerne, så har vi dækket dig med vores spise-in, takeaway og afhentningsmuligheder ved kantstenen.
Med ry for god kaffe, serverer vi også en udvalgt menu med økologiske retter, små tallerkener, vegetariske retter og et fint udvalg af alkoholiske drikke – inklusive øl, cocktails, spiritus og vin.
Vores rum tilbyder en række spisemuligheder, fra morgenmad og frokost til middag, dessert og catering. Du finder både skrankeservice og komfortable siddepladser, hvilket gør den ideel til alt fra afslappede besøg til gruppesammenkomster.
Designet til at være afslappet, hyggeligt og stille, inviterer vores atmosfære til forbindelse og ro. Vi er stolte familievenlige, LGBTQ+ inklusive og et transkønnet sikkert rum med faciliteter som kønsneutrale toiletter, pusleborde og høje stole for at sikre en stressfri oplevelse for alle.
Vi accepterer reservationer og tilbyder en række forskellige betalingsmetoder, herunder kreditkort, debetkort og NFC-mobilbetalinger. For dem, der ankommer i bil, er bekvem parkering tilgængelig på en betalingsparkering i flere etager i nærheden. Fra din første tår kaffe til din sidste bid dessert, er hvert øjeblik her omhyggeligt forberedt.
Kom for maden, bliv for oplevelsen. Hos os handler italiensk mad ikke bare om opskrifter – det handler om følelser, tradition og den ægte smag af Italien. Vores menu er inspireret af klassiske italienske retter, tilberedt med friske, nøje udvalgte råvarer og serveret med kærlighed. Fra håndlavet pasta og stenovnsbagt pizza til delikate antipasti og cremede risottoer – hver ret er en hyldest til det italienske køkken.
Vores kokke bringer det bedste fra middelhavet til dit bord, med fokus på kvalitet, balance og smag. Uanset om du vælger en simpel Margherita eller en fyldig lasagne, lover vi en smagsoplevelse, der føles som en rejse til hjertet af Italien.",
        ]);

        try {
            $page->addMedia(public_path('img/about/about.jpg'))
                 ->preservingOriginal()
                 ->toMediaCollection('image');
        } catch (Exception) {
            // do nothing
        }
    }
}
