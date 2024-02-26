<?php

namespace Database\Seeders;

use App\Enums\GoodEnum;
use App\Enums\GoodTypeEnum;
use App\Models\Good;
use App\Models\GoodType;
use Illuminate\Database\Seeder;

class GoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Good::query()->delete();
        foreach ($this->goods() as $goodTypeName => $good) {
            $goodTypeId = GoodType::query()->where('name', '=', $goodTypeName)->firstOrFail()->id;

            foreach ($good as $key => $value) {
                Good::factory()->create([
                    'name' => $value,
                    'title' => $value,
                    'description' => $value,
                    'cost' => 15000,
                    'good_type_id' => $goodTypeId,
                ]);
            }
        }
    }

    public function goods(): array
    {
        return [
            GoodTypeEnum::CAMERAS->value => $this->cameras(),
            GoodTypeEnum::LENSES->value => $this->lenses(),
            GoodTypeEnum::LIGHT->value => $this->light(),
            GoodTypeEnum::SOUND->value => $this->sound(),
            GoodTypeEnum::STABILIZERS->value => $this->stabilizers(),
            GoodTypeEnum::BATTERIES->value => $this->batteries(),
            GoodTypeEnum::DRONES->value => $this->drones(),
            GoodTypeEnum::DATA_CARDS->value => $this->dataCards(),
            GoodTypeEnum::CAGES->value => $this->cages(),
            GoodTypeEnum::DISPLAYS->value => $this->displays(),
            GoodTypeEnum::MISCELLANEOUS->value => $this->miscellaneous(),
            GoodTypeEnum::SOFTBOXES->value => $this->softboxes(),
            GoodTypeEnum::FILTERS->value => $this->filters(),
            GoodTypeEnum::STANDS->value => $this->stands(),
            GoodTypeEnum::KITS->value => $this->kits(),
        ];
    }

    public function cameras(): array
    {
        return [
            GoodEnum::CINEMA_CAMERA_SONY_FX6->name => GoodEnum::CINEMA_CAMERA_SONY_FX6->value,
            GoodEnum::CINEMA_CAMERA_BLACKMAGIC_6K_PRO->name => GoodEnum::CINEMA_CAMERA_BLACKMAGIC_6K_PRO->value,
            GoodEnum::CINEMA_CAMERA_SONY_FX3->name => GoodEnum::CINEMA_CAMERA_SONY_FX3->value,
            GoodEnum::CINEMA_CAMERA_SONY_FX30->name => GoodEnum::CINEMA_CAMERA_SONY_FX30->value,
            GoodEnum::PHOTO_CAMERA_CANON_R7->name => GoodEnum::PHOTO_CAMERA_CANON_R7->value,
            GoodEnum::PHOTO_CAMERA_CANON_R->name => GoodEnum::PHOTO_CAMERA_CANON_R->value,
            GoodEnum::PHOTO_CAMERA_SONY_A7_III->name => GoodEnum::PHOTO_CAMERA_SONY_A7_III->value,
            GoodEnum::PHOTO_CAMERA_SONY_A7C->name => GoodEnum::PHOTO_CAMERA_SONY_A7C->value,
            GoodEnum::PHOTO_CAMERA_SONY_A7_IV->name => GoodEnum::PHOTO_CAMERA_SONY_A7_IV->value,
            GoodEnum::PHOTO_CAMERA_SONY_A6600->name => GoodEnum::PHOTO_CAMERA_SONY_A6600->value,
            GoodEnum::PHOTO_CAMERA_SONY_A6400->name => GoodEnum::PHOTO_CAMERA_SONY_A6400->value,
            GoodEnum::PHOTO_CAMERA_FUJIFILM_T4->name => GoodEnum::PHOTO_CAMERA_FUJIFILM_T4->value,
            GoodEnum::PHOTO_CAMERA_FUJIFILM_T3->name => GoodEnum::PHOTO_CAMERA_FUJIFILM_T3->value,
            GoodEnum::ACTION_CAMERA_GO_PRO_11->name => GoodEnum::ACTION_CAMERA_GO_PRO_11->value,
        ];
    }

    public function lenses(): array
    {
        return [
            GoodEnum::OBJECTIVE_SONY_16_50MM_F3_5_5_6_OSS->name => GoodEnum::OBJECTIVE_SONY_16_50MM_F3_5_5_6_OSS,
            GoodEnum::OBJECTIVE_SONY_28_70MM_F3_5_5_6_OSS->name => GoodEnum::OBJECTIVE_SONY_28_70MM_F3_5_5_6_OSS->value,
            GoodEnum::OBJECTIVE_SONY_28_60MM_F4_5_6_OSS->name => GoodEnum::OBJECTIVE_SONY_28_60MM_F4_5_6_OSS->value,
            GoodEnum::OBJECTIVE_SONY_ZEISS_28_70MM_F4_OSS->name => GoodEnum::OBJECTIVE_SONY_ZEISS_28_70MM_F4_OSS->value,
            GoodEnum::OBJECTIVE_SONY_85MM_GM_F1_4->name => GoodEnum::OBJECTIVE_SONY_85MM_GM_F1_4->value,
            GoodEnum::OBJECTIVE_SONY_35MM_GM_F1_4->name => GoodEnum::OBJECTIVE_SONY_35MM_GM_F1_4->value,
            GoodEnum::OBJECTIVE_SONY_70_200_MM_GM_II_F2_8->name => GoodEnum::OBJECTIVE_SONY_70_200_MM_GM_II_F2_8,
            GoodEnum::OBJECTIVE_SONY_20MM_G_F1_8->name => GoodEnum::OBJECTIVE_SONY_20MM_G_F1_8->value,
            GoodEnum::OBJECTIVE_SONY_18_105MM_G_F4->name => GoodEnum::OBJECTIVE_SONY_18_105MM_G_F4->value,
            GoodEnum::OBJECTIVE_SONY_18_135MM_F3_5_5_6->name => GoodEnum::OBJECTIVE_SONY_18_135MM_F3_5_5_6->value,
            GoodEnum::OBJECTIVE_SONY_50MM_F1_8->name => GoodEnum::OBJECTIVE_SONY_50MM_F1_8->value,
            GoodEnum::OBJECTIVE_TAMRON_28_75MM_F2_8_RXD_SONY->name => GoodEnum::OBJECTIVE_TAMRON_28_75MM_F2_8_RXD_SONY->value,
            GoodEnum::OBJECTIVE_TAMRON_17_70MM_F2_8_RXD_SONY->name => GoodEnum::OBJECTIVE_TAMRON_17_70MM_F2_8_RXD_SONY->value,
            GoodEnum::OBJECTIVE_SIGMA_ART_24_70MM_F2_8_DG_DN_SONY->name => GoodEnum::OBJECTIVE_SIGMA_ART_24_70MM_F2_8_DG_DN_SONY->value,
            GoodEnum::OBJECTIVE_SIGMA_70MM_F2_8_DG_MACRO_SONY->name => GoodEnum::OBJECTIVE_SIGMA_70MM_F2_8_DG_MACRO_SONY->value,
            GoodEnum::OBJECTIVE_SIGMA_ART_16_28MM_F2_8_DG_DN_SONY->name => GoodEnum::OBJECTIVE_SIGMA_ART_16_28MM_F2_8_DG_DN_SONY->value,
            GoodEnum::OBJECTIVE_SIGMA_56MM_F1_4_DC_DN_SONY->name => GoodEnum::OBJECTIVE_SIGMA_56MM_F1_4_DC_DN_SONY->value,
            GoodEnum::OBJECTIVE_SIGMA_30MM_F1_4_DC_DN_SONY->name => GoodEnum::OBJECTIVE_SIGMA_30MM_F1_4_DC_DN_SONY->value,
            GoodEnum::OBJECTIVE_SIGMA_16MM_F1_4_DC_DN_SONY->name => GoodEnum::OBJECTIVE_SIGMA_16MM_F1_4_DC_DN_SONY->value,
            GoodEnum::OBJECTIVE_SIRUI_50MM_F1_8_ANAMORPHIC_SONY->name => GoodEnum::OBJECTIVE_SIRUI_50MM_F1_8_ANAMORPHIC_SONY->value,
            GoodEnum::FUJINON_18_55MM->name => GoodEnum::FUJINON_18_55MM->value,
            GoodEnum::CANON_RF_50MM_F1_8->name => GoodEnum::CANON_RF_50MM_F1_8->value,
            GoodEnum::CANON_RF_24_105_MM_F4_7_1->name => GoodEnum::CANON_RF_24_105_MM_F4_7_1->value,
            GoodEnum::SAMYANG_14MM_CANON->name => GoodEnum::SAMYANG_14MM_CANON->value,
            GoodEnum::SAMYANG_24MM_CANON->name => GoodEnum::SAMYANG_24MM_CANON->value,
            GoodEnum::SAMYANG_135MM_CANON->name => GoodEnum::SAMYANG_135MM_CANON->value,
            GoodEnum::SAMYANG_85MM_CANON->name => GoodEnum::SAMYANG_85MM_CANON->value,
            GoodEnum::SAMYANG_35MM_CANON->name => GoodEnum::SAMYANG_35MM_CANON->value,
            GoodEnum::SIGMA_ART_18_35_MM_DC_CANON->name => GoodEnum::SIGMA_ART_18_35_MM_DC_CANON->value,
            GoodEnum::SIGMA_ART_24_70MM_DG_CANON->name => GoodEnum::SIGMA_ART_24_70MM_DG_CANON->value,
        ];
    }

    private function light(): array
    {
        return [
            GoodEnum::APUTURE_300X->name => GoodEnum::APUTURE_300X->value,
            GoodEnum::APUTURE_600X->name => GoodEnum::APUTURE_600X->value,
            GoodEnum::APUTURE_NOVA_P300_KIT->name => GoodEnum::APUTURE_NOVA_P300_KIT->value,
            GoodEnum::APUTURE_MC_RGBW_2->name => GoodEnum::APUTURE_MC_RGBW_2->value,
            GoodEnum::AMARAN_150C->name => GoodEnum::AMARAN_150C->value,
            GoodEnum::GODOX_SL200III->name => GoodEnum::GODOX_SL200III->value,
            GoodEnum::GODOX_SL100BI->name => GoodEnum::GODOX_SL100BI->value,
            GoodEnum::GODOX_AD300PRO->name => GoodEnum::GODOX_AD300PRO->value,
            GoodEnum::NANLITE_FORZA_60C->name => GoodEnum::NANLITE_FORZA_60C->value,
            GoodEnum::APUTURE_100X->name => GoodEnum::APUTURE_100X->value,
            GoodEnum::GODOX_TL60->name => GoodEnum::GODOX_TL60->value,
            GoodEnum::WEYLIGHT_DJEDAIKA->name => GoodEnum::WEYLIGHT_DJEDAIKA->value,
            GoodEnum::GODOX_V1_FLASH->name => GoodEnum::GODOX_V1_FLASH->value,
            GoodEnum::GODOX_V860_FLASH->name => GoodEnum::GODOX_V860_FLASH->value,
            GoodEnum::NANLITE_DJEDAIKA_30CM->name => GoodEnum::NANLITE_DJEDAIKA_30CM->value,
            GoodEnum::APUTURE_AMARAN_P60C->name => GoodEnum::APUTURE_AMARAN_P60C->value,
        ];
    }

    private function sound(): array
    {
        return [
            GoodEnum::DJI_MIC_DUO->name => GoodEnum::DJI_MIC_DUO->value,
            GoodEnum::DJI_MIC_2_DUO->name => GoodEnum::DJI_MIC_2_DUO->value,
            GoodEnum::HOLLYLAND_LARK_MAX->name => GoodEnum::HOLLYLAND_LARK_MAX->value,
            GoodEnum::RODE_GO_2->name => GoodEnum::RODE_GO_2->value,
            GoodEnum::BOYA_WM4_PRO_K2->name => GoodEnum::BOYA_WM4_PRO_K2->value,
            GoodEnum::SARAMONIC_UWMIC9_TX_TX_RX->name => GoodEnum::SARAMONIC_UWMIC9_TX_TX_RX->value,
            GoodEnum::MICROPHONE_RODE_VIDEOMIC_PRO->name => GoodEnum::MICROPHONE_RODE_VIDEOMIC_PRO->value,
            GoodEnum::WALKIE_TALKIE_LUITON_316->name => GoodEnum::WALKIE_TALKIE_LUITON_316->value,
            GoodEnum::AUDIO_RECORDER_ZOOM_H6->name => GoodEnum::AUDIO_RECORDER_ZOOM_H6->value,
        ];
    }

    private function stabilizers(): array
    {
        return [
            GoodEnum::RONIN_RS_2->name => GoodEnum::RONIN_RS_2->value,
            GoodEnum::RONIN_SC->name => GoodEnum::RONIN_SC->value,
            GoodEnum::OSMO_4->name => GoodEnum::OSMO_4->value,
        ];
    }

    private function batteries(): array
    {
        return [
            GoodEnum::CHARGEABLE_BATTERIES_AA_BLOCK->name => GoodEnum::CHARGEABLE_BATTERIES_AA_BLOCK->value,
            GoodEnum::SONY_NP_FZ100->name => GoodEnum::SONY_NP_FZ100->value,
            GoodEnum::SONY_NP_FW50->name => GoodEnum::SONY_NP_FW50->value,
            GoodEnum::FUJIFILM_NP_W126->name => GoodEnum::FUJIFILM_NP_W126->value,
            GoodEnum::FUJIFILM_NP_W235->name => GoodEnum::FUJIFILM_NP_W235->value,
            GoodEnum::CANON_LP_E6NH->name => GoodEnum::CANON_LP_E6NH->value,
            GoodEnum::BLACKMAGIC_BATTERY->name => GoodEnum::BLACKMAGIC_BATTERY->value,
            GoodEnum::FUJIFILM_NP_W235_DUMMY_BATTERY->name => GoodEnum::FUJIFILM_NP_W235_DUMMY_BATTERY->value,
            GoodEnum::SONY_NP_FZ100_DUMMY_BATTERY->name => GoodEnum::SONY_NP_FZ100_DUMMY_BATTERY->value,
            GoodEnum::BOYA_IPHONE_ADAPTER_CABLE->name => GoodEnum::BOYA_IPHONE_ADAPTER_CABLE->value,
            GoodEnum::NP_FZ100_JUPIO_CHARGER->name => GoodEnum::NP_FZ100_JUPIO_CHARGER->value,
            GoodEnum::NP_FZ100_SONY_CHARGER->name => GoodEnum::NP_FZ100_SONY_CHARGER->value,
            GoodEnum::NP_FW50_SONY_CHARGER->name => GoodEnum::NP_FW50_SONY_CHARGER->value,
            GoodEnum::NP_FW50_JUPIO_CHARGER->name => GoodEnum::NP_FW50_JUPIO_CHARGER->value,
            GoodEnum::GOPRO_BATTERIES->name => GoodEnum::GOPRO_BATTERIES->value,
            GoodEnum::NPF_970_SET_OF_12->name => GoodEnum::NPF_970_SET_OF_12->value,
            GoodEnum::NPF_750_SET_OF_1->name => GoodEnum::NPF_750_SET_OF_1->value,
            GoodEnum::SMALL_RIG_V_MOUNT_99WH->name => GoodEnum::SMALL_RIG_V_MOUNT_99WH->value,
            GoodEnum::AIR_2_BATTERIES->name => GoodEnum::AIR_2_BATTERIES->value,
        ];
    }

    private function drones(): array
    {
        return [
            GoodEnum::DJI_AIR_2->name => GoodEnum::DJI_AIR_2->value,
        ];
    }

    private function dataCards(): array
    {
        return [
            GoodEnum::SANDISK_64GB->name => GoodEnum::SANDISK_64GB->value,
            GoodEnum::SANDISK_128GB_170MB_S->name => GoodEnum::SANDISK_128GB_170MB_S->value,
            GoodEnum::MICRO_SANDISK_64_GB->name => GoodEnum::MICRO_SANDISK_64_GB->value,
            GoodEnum::SONY_256GB_UHS_2->name => GoodEnum::SONY_256GB_UHS_2->value,
            GoodEnum::TOUGH_80GB_G_800_MBS->name => GoodEnum::TOUGH_80GB_G_800_MBS->value,
            GoodEnum::SAMSUNG_EVO_PLUS_64GB->name => GoodEnum::SAMSUNG_EVO_PLUS_64GB->value,
            GoodEnum::SAMSUNG_EVO_PLUS_256GB->name => GoodEnum::SAMSUNG_EVO_PLUS_256GB->value,
            GoodEnum::MICRO_64GB_ADATA->name => GoodEnum::MICRO_64GB_ADATA->value,
            GoodEnum::SAMSUNG_T7_1TB->name => GoodEnum::SAMSUNG_T7_1TB->value,
        ];
    }

    private function cages(): array
    {
        return [
            GoodEnum::UURIG_HAND_FOR_SONY_A7_3->name => GoodEnum::UURIG_HAND_FOR_SONY_A7_3->value,
            GoodEnum::UURIG_FOR_FUJIFILM_T4->name => GoodEnum::UURIG_FOR_FUJIFILM_T4->value,
            GoodEnum::SMALLRIG_FOR_A7C->name => GoodEnum::SMALLRIG_FOR_A7C->value,
            GoodEnum::SMALLRIG_HAND_AND_HANDLE_A6600->name => GoodEnum::SMALLRIG_HAND_AND_HANDLE_A6600->value,
            GoodEnum::TILTA_ADVANCED_FX6->name => GoodEnum::TILTA_ADVANCED_FX6->value,
            GoodEnum::TILTA_ADVANCED_KIT_FX3->name => GoodEnum::TILTA_ADVANCED_KIT_FX3->value,
        ];
    }

    private function displays(): array
    {
        return [
            GoodEnum::FEELWORLD_LUT_7_4K_HDMI->name => GoodEnum::FEELWORLD_LUT_7_4K_HDMI->value,
            GoodEnum::LILIPUT_4K->name => GoodEnum::LILIPUT_4K->value,
            GoodEnum::FEELWORLD_4K_ULTRA->name => GoodEnum::FEELWORLD_4K_ULTRA->value,
        ];
    }

    private function miscellaneous(): array
    {
        return [
            GoodEnum::VIDEOSENDERS_HOLLYLAND_MARS_400S_PRO->name => GoodEnum::VIDEOSENDERS_HOLLYLAND_MARS_400S_PRO->value,
            GoodEnum::TELEPROMPTER_FEELWORLD_TP10->name => GoodEnum::TELEPROMPTER_FEELWORLD_TP10->value,
            GoodEnum::REFLECTOR->name => GoodEnum::REFLECTOR->value,
            GoodEnum::CHROMAKEY_200X150->name => GoodEnum::CHROMAKEY_200X150->value,
            GoodEnum::SYNCHRONIZER_GODOX_X_PRO->name => GoodEnum::SYNCHRONIZER_GODOX_X_PRO->value,
            GoodEnum::MONOPOD->name => GoodEnum::MONOPOD->value,
            GoodEnum::COMPENDIUM_SMALLRIG->name => GoodEnum::COMPENDIUM_SMALLRIG->value,
            GoodEnum::SMOKE_MACHINE_900W->name => GoodEnum::SMOKE_MACHINE_900W->value,
        ];
    }

    private function softboxes(): array
    {
        return [
            GoodEnum::SOFTBOX_LATERN_90->name => GoodEnum::SOFTBOX_LATERN_90->value,
            GoodEnum::SOFTBOX_OCTADOME_120->name => GoodEnum::SOFTBOX_OCTADOME_120->value,
            GoodEnum::SOFTBOX_LIGHT_DOME_150->name => GoodEnum::SOFTBOX_LIGHT_DOME_150->value,
            GoodEnum::SOFTBOX_GODOX_60_60->name => GoodEnum::SOFTBOX_GODOX_60_60->value,
            GoodEnum::FLASH_SOFTBOX->name => GoodEnum::FLASH_SOFTBOX->value,
        ];
    }

    private function filters(): array
    {
        return [
            GoodEnum::ND_FREEWELL_67MM->name => GoodEnum::ND_FREEWELL_67MM->value,
            GoodEnum::ND_77MM->name => GoodEnum::ND_77MM->value,
            GoodEnum::ND_58MM->name => GoodEnum::ND_58MM->value,
            GoodEnum::ND_72MM->name => GoodEnum::ND_72MM->value,
            GoodEnum::TIFFEN_MIST_FILTER_67MM->name => GoodEnum::TIFFEN_MIST_FILTER_67MM->value,
            GoodEnum::POLARIZED_77MM->name => GoodEnum::POLARIZED_77MM->value,
        ];
    }

    private function stands(): array
    {
        return [
            GoodEnum::LIGHT_STAND_GODOX_213B->name => GoodEnum::LIGHT_STAND_GODOX_213B->value,
            GoodEnum::LIGHT_STAND_GODOX_380->name => GoodEnum::LIGHT_STAND_GODOX_380->value,
            GoodEnum::LIGHT_STAND_GODOX_SL->name => GoodEnum::LIGHT_STAND_GODOX_SL->value,
            GoodEnum::REGULAR_LIGHT_STAND->name => GoodEnum::REGULAR_LIGHT_STAND->value,
            GoodEnum::NO_NAME_LIGHT_STANDS->name => GoodEnum::NO_NAME_LIGHT_STANDS->value,
            GoodEnum::LARGE_NO_NAME_LIGHT_STAND->name => GoodEnum::LARGE_NO_NAME_LIGHT_STAND->value,
            GoodEnum::C_STAND_K2_MEKING->name => GoodEnum::C_STAND_K2_MEKING->value,
            GoodEnum::TRIPOD_COMAN->name => GoodEnum::TRIPOD_COMAN->value,
            GoodEnum::ALUMINUM_TRIPOD->name => GoodEnum::ALUMINUM_TRIPOD->value,
            GoodEnum::BLACK_TRIPOD->name => GoodEnum::BLACK_TRIPOD->value,
            GoodEnum::CONTINENTAL_TRIPOD_DAMAGED->name => GoodEnum::CONTINENTAL_TRIPOD_DAMAGED->value,
        ];
    }

    private function kits(): array
    {
        return [];
    }
}
