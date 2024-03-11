<?php

namespace Database\Seeders;

use App\Enums\GoodEnum;
use App\Models\Good;
use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::query()->delete();
        foreach ($this->goodsAmount() as $goodName => $amount) {
            $goodId = Good::query()->where('name', '=', $goodName)->firstOrFail();
            for ($i = 0; $i < $amount; $i++) {
                Item::factory()->create([
                    'good_id' => $goodId,
                    'status' => 'available',
                ]);
            }
        }
    }

    public function goodsAmount(): array
    {
        return [
            GoodEnum::CINEMA_CAMERA_SONY_FX6->value => 1,
            GoodEnum::CINEMA_CAMERA_BLACKMAGIC_6K_PRO->value => 1,
            GoodEnum::CINEMA_CAMERA_SONY_FX3->value => 1,
            GoodEnum::CINEMA_CAMERA_SONY_FX30->value => 1,
            GoodEnum::PHOTO_CAMERA_CANON_R7->value => 1,
            GoodEnum::PHOTO_CAMERA_CANON_R->value => 1,
            GoodEnum::PHOTO_CAMERA_SONY_A7_III->value => 3,
            GoodEnum::PHOTO_CAMERA_SONY_A7C->value => 1,
            GoodEnum::PHOTO_CAMERA_SONY_A7_IV->value => 2,
            GoodEnum::PHOTO_CAMERA_SONY_A6600->value => 1,
            GoodEnum::PHOTO_CAMERA_SONY_A6400->value => 2,
            GoodEnum::PHOTO_CAMERA_FUJIFILM_T4->value => 1,
            GoodEnum::PHOTO_CAMERA_FUJIFILM_T3->value => 2,
            GoodEnum::ACTION_CAMERA_GO_PRO_11->value => 1,
            GoodEnum::OBJECTIVE_SONY_16_50MM_F3_5_5_6_OSS->value => 1,
            GoodEnum::OBJECTIVE_SONY_28_70MM_F3_5_5_6_OSS->value => 2,
            GoodEnum::OBJECTIVE_SONY_28_60MM_F4_5_6_OSS->value => 1,
            GoodEnum::OBJECTIVE_SONY_ZEISS_28_70MM_F4_OSS->value => 1,
            GoodEnum::OBJECTIVE_SONY_85MM_GM_F1_4->value => 1,
            GoodEnum::OBJECTIVE_SONY_35MM_GM_F1_4->value => 1,
            GoodEnum::OBJECTIVE_SONY_70_200_MM_GM_II_F2_8->value => 1,
            GoodEnum::OBJECTIVE_SONY_20MM_G_F1_8->value => 1,
            GoodEnum::OBJECTIVE_SONY_18_105MM_G_F4->value => 1,
            GoodEnum::OBJECTIVE_SONY_18_135MM_F3_5_5_6->value => 1,
            GoodEnum::OBJECTIVE_SONY_50MM_F1_8->value => 1,
            GoodEnum::OBJECTIVE_TAMRON_28_75MM_F2_8_RXD_SONY->value => 1,
            GoodEnum::OBJECTIVE_TAMRON_17_70MM_F2_8_RXD_SONY->value => 1,
            GoodEnum::OBJECTIVE_SIGMA_ART_24_70MM_F2_8_DG_DN_SONY->value => 1,
            GoodEnum::OBJECTIVE_SIGMA_70MM_F2_8_DG_MACRO_SONY->value => 1,
            GoodEnum::OBJECTIVE_SIGMA_ART_16_28MM_F2_8_DG_DN_SONY->value => 1,
            GoodEnum::OBJECTIVE_SIGMA_56MM_F1_4_DC_DN_SONY->value => 1,
            GoodEnum::OBJECTIVE_SIGMA_30MM_F1_4_DC_DN_SONY->value => 1,
            GoodEnum::OBJECTIVE_SIGMA_16MM_F1_4_DC_DN_SONY->value => 2,
            GoodEnum::OBJECTIVE_SIRUI_50MM_F1_8_ANAMORPHIC_SONY->value => 1,
            GoodEnum::FUJINON_18_55MM->value => 2,
            GoodEnum::CANON_RF_50MM_F1_8->value => 1,
            GoodEnum::CANON_RF_24_105_MM_F4_7_1->value => 1,
            GoodEnum::SAMYANG_14MM_CANON->value => 1,
            GoodEnum::SAMYANG_24MM_CANON->value => 1,
            GoodEnum::SAMYANG_135MM_CANON->value => 1,
            GoodEnum::SAMYANG_85MM_CANON->value => 1,
            GoodEnum::SAMYANG_35MM_CANON->value => 1,
            GoodEnum::SIGMA_ART_18_35_MM_DC_CANON->value => 2,
            GoodEnum::SIGMA_ART_24_70MM_DG_CANON->value => 1,
            GoodEnum::APUTURE_300X->value => 2,
            GoodEnum::APUTURE_600X->value => 1,
            GoodEnum::APUTURE_NOVA_P300_KIT->value => 1,
            GoodEnum::APUTURE_MC_RGBW_2->value => 2,
            GoodEnum::AMARAN_150C->value => 1,
            GoodEnum::GODOX_SL200III->value => 2,
            GoodEnum::GODOX_SL100BI->value => 4,
            GoodEnum::GODOX_AD300PRO->value => 1,
            GoodEnum::NANLITE_FORZA_60C->value => 3,
            GoodEnum::APUTURE_100X->value => 1,
            GoodEnum::GODOX_TL60->value => 3,
            GoodEnum::GODOX_V1_FLASH->value => 1,
            GoodEnum::GODOX_V860_FLASH->value => 1,
            GoodEnum::NANLITE_DJEDAIKA_30CM->value => 1,
            GoodEnum::APUTURE_AMARAN_P60C->value => 3,
            GoodEnum::DJI_MIC_DUO->value => 1,
            GoodEnum::DJI_MIC_2_DUO->value => 1,
            GoodEnum::HOLLYLAND_LARK_MAX->value => 2,
            GoodEnum::RODE_GO_2->value => 2,
            GoodEnum::BOYA_WM4_PRO_K2->value => 1,
            GoodEnum::SARAMONIC_UWMIC9_TX_TX_RX->value => 1,
            GoodEnum::MICROPHONE_RODE_VIDEOMIC_PRO->value => 3,
            GoodEnum::WALKIE_TALKIE_LUITON_316->value => 4,
            GoodEnum::AUDIO_RECORDER_ZOOM_H6->value => 1,
            GoodEnum::RONIN_RS_2->value => 3,
            GoodEnum::RONIN_SC->value => 1,
            GoodEnum::OSMO_4->value => 2,
            GoodEnum::SONY_NP_FZ100->value => 14,
            GoodEnum::SONY_NP_FW50->value => 5,
            GoodEnum::FUJIFILM_NP_W126->value => 2,
            GoodEnum::FUJIFILM_NP_W235->value => 2,
            GoodEnum::CANON_LP_E6NH->value => 4,
            GoodEnum::FUJIFILM_NP_W235_DUMMY_BATTERY->value => 1,
            GoodEnum::SONY_NP_FZ100_DUMMY_BATTERY->value => 2,
            GoodEnum::BOYA_IPHONE_ADAPTER_CABLE->value => 3,
            GoodEnum::NP_FZ100_SONY_CHARGER->value => 2,
            GoodEnum::NP_FW50_SONY_CHARGER->value => 1,
            GoodEnum::GOPRO_BATTERIES->value => 3,
            GoodEnum::NPF_970_SET_OF_12->value => 12,
            GoodEnum::NPF_750_SET_OF_1->value => 1,
            GoodEnum::SMALL_RIG_V_MOUNT_99WH->value => 2,
            GoodEnum::AIR_2_BATTERIES->value => 5,
            GoodEnum::DJI_AIR_2->value => 1,
            GoodEnum::SANDISK_64GB->value => 7,
            GoodEnum::SANDISK_128GB_170MB_S->value => 4,
            GoodEnum::MICRO_SANDISK_64_GB->value => 1,
            GoodEnum::SONY_256GB_UHS_2->value => 1,
            GoodEnum::TOUGH_80GB_G_800_MBS->value => 1,
            GoodEnum::SAMSUNG_EVO_PLUS_64GB->value => 1,
            GoodEnum::SAMSUNG_EVO_PLUS_256GB->value => 1,
            GoodEnum::MICRO_64GB_ADATA->value => 2,
            GoodEnum::SAMSUNG_T7_1TB->value => 1,
            GoodEnum::UURIG_HAND_FOR_SONY_A7_3->value => 1,
            GoodEnum::UURIG_FOR_FUJIFILM_T4->value => 1,
            GoodEnum::SMALLRIG_FOR_A7C->value => 1,
            GoodEnum::SMALLRIG_HAND_AND_HANDLE_A6600->value => 1,
            GoodEnum::TILTA_ADVANCED_FX6->value => 1,
            GoodEnum::TILTA_ADVANCED_KIT_FX3->value => 1,
            GoodEnum::FEELWORLD_LUT_7_4K_HDMI->value => 1,
            GoodEnum::LILIPUT_4K->value => 1,
            GoodEnum::FEELWORLD_4K_ULTRA->value => 1,
            GoodEnum::VIDEOSENDERS_HOLLYLAND_MARS_400S_PRO->value => 1,
            GoodEnum::TELEPROMPTER_FEELWORLD_TP10->value => 1,
            GoodEnum::REFLECTOR->value => 1,
            GoodEnum::CHROMAKEY_200X150->value => 1,
            GoodEnum::SYNCHRONIZER_GODOX_X_PRO->value => 1,
            GoodEnum::MONOPOD->value => 1,
            GoodEnum::COMPENDIUM_SMALLRIG->value => 1,
            GoodEnum::SMOKE_MACHINE_900W->value => 1,
            GoodEnum::SOFTBOX_LATERN_90->value => 2,
            GoodEnum::SOFTBOX_OCTADOME_120->value => 1,
            GoodEnum::SOFTBOX_LIGHT_DOME_150->value => 1,
            GoodEnum::SOFTBOX_GODOX_60_60->value => 1,
            GoodEnum::FLASH_SOFTBOX->value => 1,
            GoodEnum::ND_FREEWELL_67MM->value => 1,
            GoodEnum::ND_77MM->value => 1,
            GoodEnum::ND_58MM->value => 1,
            GoodEnum::ND_72MM->value => 1,
            GoodEnum::TIFFEN_MIST_FILTER_67MM->value => 1,
            GoodEnum::POLARIZED_77MM->value => 1,
            GoodEnum::LIGHT_STAND_GODOX_213B->value => 3,
            GoodEnum::LIGHT_STAND_GODOX_380->value => 2,
            GoodEnum::LIGHT_STAND_GODOX_SL->value => 6,
            GoodEnum::NO_NAME_LIGHT_STANDS->value => 3,
            GoodEnum::LARGE_NO_NAME_LIGHT_STAND->value => 1,
            GoodEnum::C_STAND_K2_MEKING->value => 1,
            GoodEnum::TRIPOD_COMAN->value => 2,
            GoodEnum::ALUMINUM_TRIPOD->value => 2,
            GoodEnum::WEIFENG_TRIPOD->value => 1,
            GoodEnum::CONTINENTAL_TRIPOD_DAMAGED->value => 2,
            GoodEnum::SONY_FX6_V_MOUNT_SET->value => 1,
            GoodEnum::BLACKMAGIC_6K_PRO_FULL_SET->value => 1,
            GoodEnum::APUTURE_300X_LED_LIGHTS_SET->value => 1,
            GoodEnum::GODOX_SL200IIID_LED_LIGHTS_SET->value => 1,
            GoodEnum::GODOX_SL100BI_LED_LIGHTS_SET->value => 1,
            GoodEnum::NANLITE_FORZA_60C_LED_LIGHTS_SET->value => 1,
            GoodEnum::APUTURE_AMARAN_P60C_LED_LIGHTS_SET->value => 1,
            GoodEnum::GODOX_TL60_JEDI_LIGHTS_SET->value => 1,
            GoodEnum::NANLITE_30CM_JEDI_LIGHTS_SET->value => 1,
        ];
    }
}
