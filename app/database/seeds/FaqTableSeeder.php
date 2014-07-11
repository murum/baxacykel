<?php

class FaqTableSeeder extends Seeder {

    public function run()
    {
        DB::table('faq')->delete();

        $data = array(
            array(
                'question' => 'Vad är pedaler och pedalshoppen?',
                'answer' => 'Pedaler är en virtuell valuta i BaxaCykel. Med denna virtuella valuta kan du köpa olika mindre fördelar i ditt spelande...',
            )
        );

        DB::table('faq')->insert($data);
    }

}