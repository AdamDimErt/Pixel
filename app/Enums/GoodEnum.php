<?php

namespace App\Enums;

enum GoodEnum: string
{
    // Камеры
    case CINEMA_CAMERA_SONY_FX6 = 'Кинокамера Sony FX6';
    case CINEMA_CAMERA_BLACKMAGIC_6K_PRO = 'Кинокамера Blackmagic 6k pro';
    case CINEMA_CAMERA_SONY_FX3 = 'Кинокамера Sony Fx3';
    case CINEMA_CAMERA_SONY_FX30 = 'Кинокамера Sony Fx30';
    case PHOTO_CAMERA_CANON_R7 = 'Фотоаппарат Canon R7';
    case PHOTO_CAMERA_CANON_R = 'Фотоаппарат Canon R';
    case PHOTO_CAMERA_SONY_A7_III = 'Фотоаппарат Sony A7 III';
    case PHOTO_CAMERA_SONY_A7C = 'Фотоаппарат Sony A7C';
    case PHOTO_CAMERA_SONY_A7_IV = 'Фотоаппарат Sony A7 IV';
    case PHOTO_CAMERA_SONY_A6600 = 'Фотоаппарат Sony A6600';
    case PHOTO_CAMERA_SONY_A6400 = 'Фотоаппарат Sony A6400';
    case PHOTO_CAMERA_FUJIFILM_T4 = 'Фотоаппарат Fujifilm T4';
    case PHOTO_CAMERA_FUJIFILM_T3 = 'Фотоаппарат Fujifilm T3';
    case ACTION_CAMERA_GO_PRO_11 = 'Экшн камера Go pro 11';
    // Объективы
    case OBJECTIVE_SONY_16_50MM_F3_5_5_6_OSS = 'Объектив Sony 16-50mm f3.5-5.6 oss';
    case OBJECTIVE_SONY_28_70MM_F3_5_5_6_OSS = 'Объектив Sony 28-70mm f3.5-5.6 oss';
    case OBJECTIVE_SONY_28_60MM_F4_5_6_OSS = 'Объектив Sony 28-60mm f4-5.6 oss';
    case OBJECTIVE_SONY_ZEISS_28_70MM_F4_OSS = 'Объектив Sony Zeiss 28-70mm f4 oss';
    case OBJECTIVE_SONY_85MM_GM_F1_4 = 'Объектив Sony 85mm GM F1.4';
    case OBJECTIVE_SONY_35MM_GM_F1_4 = 'Объектив Sony 35mm GM F1.4';
    case OBJECTIVE_SONY_70_200_MM_GM_II_F2_8 = 'Объектив Sony 70-200 mm GM II F2.8';
    case OBJECTIVE_SONY_20MM_G_F1_8 = 'Объектив Sony 20mm G F1.8';
    case OBJECTIVE_SONY_18_105MM_G_F4 = 'Объектив Sony 18-105mm G F4';
    case OBJECTIVE_SONY_18_135MM_F3_5_5_6 = 'Объектив Sony 18-135mm F3.5-5.6';
    case OBJECTIVE_SONY_50MM_F1_8 = 'Объектив Sony 50mm F1.8';
    case OBJECTIVE_TAMRON_28_75MM_F2_8_RXD_SONY = 'Объектив Tamron 28-75mm f2.8 RXD Sony';
    case OBJECTIVE_TAMRON_17_70MM_F2_8_RXD_SONY = 'Объектив Tamron 17-70mm f2.8 RXD Sony';
    case OBJECTIVE_SIGMA_ART_24_70MM_F2_8_DG_DN_SONY = 'Объектив Sigma Art 24-70mm f2.8 DG DN Sony';
    case OBJECTIVE_SIGMA_70MM_F2_8_DG_MACRO_SONY = 'Объектив Sigma 70mm f2.8 DG Macro Sony';
    case OBJECTIVE_SIGMA_ART_16_28MM_F2_8_DG_DN_SONY = 'Объектив Sigma Art 16-28mm f2.8 DG DN Sony';
    case OBJECTIVE_SIGMA_56MM_F1_4_DC_DN_SONY = 'Объектив Sigma 56mm f1.4 DC DN Sony';
    case OBJECTIVE_SIGMA_30MM_F1_4_DC_DN_SONY = 'Объектив Sigma 30mm f1.4 DC DN Sony';
    case OBJECTIVE_SIGMA_16MM_F1_4_DC_DN_SONY = 'Объектив Sigma 16mm f1.4 DC DN Sony';
    case OBJECTIVE_SIRUI_50MM_F1_8_ANAMORPHIC_SONY = 'Объектив Sirui 50mm f1.8 Anamorphic Sony';
    case FUJINON_18_55MM = 'Fujinon 18-55mm';
    case CANON_RF_50MM_F1_8 = 'Canon RF 50mm f1.8';
    case CANON_RF_24_105_MM_F4_7_1 = 'Canon RF 24-105 mm F4-7.1';
    case SAMYANG_14MM_CANON = 'Samyang 14mm canon';
    case SAMYANG_24MM_CANON = 'Samyang 24mm canon';
    case SAMYANG_135MM_CANON = 'Samyang 135mm canon';
    case SAMYANG_85MM_CANON = 'Samyang 85mm canon';
    case SAMYANG_35MM_CANON = 'Samyang 35mm canon';
    case SIGMA_ART_18_35_MM_DC_CANON = 'Sigma art 18-35 mm Dc Canon';
    case SIGMA_ART_24_70MM_DG_CANON = 'Sigma art 24-70mm DG Canon';
    // Свет
    case APUTURE_300X = 'Aputure 300x';
    case APUTURE_600X = 'Aputure 600x';
    case APUTURE_NOVA_P300_KIT = 'Aputure Nova p300 kit';
    case APUTURE_MC_RGBW_2 = 'Aputure Mc RGBW (2шт)';
    case AMARAN_150C = 'Amaran 150c';
    case GODOX_SL200III = 'Godox sl200III';
    case GODOX_SL100BI = 'Godox sl100bi';
    case GODOX_AD300PRO = 'Godox Ad300pro';
    case NANLITE_FORZA_60C = 'Nanlite Forza 60c';
    case APUTURE_100X = 'Aputure 100x';
    case GODOX_TL60 = 'Godox TL60';
    case WEYLIGHT_DJEDAIKA = 'Weylight джедайка';
    case GODOX_V1_FLASH = 'Вспышка Godox V1';
    case GODOX_V860_FLASH = 'Вспышка Godox V860';
    case NANLITE_DJEDAIKA_30CM = 'Nanlite джедайка 30см';
    case APUTURE_AMARAN_P60C = 'Aputure Amaran p60c';
    // Звук
    case DJI_MIC_DUO = 'Dji mic duo';
    case DJI_MIC_2_DUO = 'Dji Mic 2 duo';
    case HOLLYLAND_LARK_MAX = 'Hollyland  Lark Max';
    case RODE_GO_2 = 'Rode go 2';
    case BOYA_WM4_PRO_K2 = 'Boya wm4 pro k2';
    case SARAMONIC_UWMIC9_TX_TX_RX = 'Saramonic UwMic9 Tx+TX + Rx';
    case MICROPHONE_RODE_VIDEOMIC_PRO = 'Микрофон Rode videomic pro';
    case WALKIE_TALKIE_LUITON_316 = 'Рация luiton 316';
    case AUDIO_RECORDER_ZOOM_H6 = 'Рекордер Zoom H6';
    // Стабилизаторы
    case RONIN_RS_2 = 'Ronin Rs 2';
    case RONIN_SC = 'Ronin Sc';
    case OSMO_4 = 'Osmo 4';
    // Аккумуляторы
    case CHARGEABLE_BATTERIES_AA_BLOCK = 'Заряжаемые батареи AA + блок';
    case SONY_NP_FZ100 = 'Sony NP-fz100';
    case SONY_NP_FW50 = 'Sony NP-fw50';
    case FUJIFILM_NP_W126 = 'Fujifilm Np-w126';
    case FUJIFILM_NP_W235 = 'Fujifilm Np-w235';
    case CANON_LP_E6NH = 'Canon LP e6Nh';
    case BLACKMAGIC_BATTERY = 'Blackmagic battery';
    case FUJIFILM_NP_W235_DUMMY_BATTERY = 'Аккумулятор пустышка Fujifilm Np-w235';
    case SONY_NP_FZ100_DUMMY_BATTERY = 'Аккумулятор пустышка Sony NP-fz100';
    case BOYA_IPHONE_ADAPTER_CABLE = 'Шнур переходник Boya iPhone';
    case NP_FZ100_JUPIO_CHARGER = 'Зарядный блок NP-fz100 Jupio';
    case NP_FZ100_SONY_CHARGER = 'Зарядный блок NP-fz100 Sony';
    case NP_FW50_SONY_CHARGER = 'Зарядный блок NP-fw50 Sony';
    case NP_FW50_JUPIO_CHARGER = 'Зарядный блок NP-fw50 Jupio';
    case GOPRO_BATTERIES = 'Батарейки Go pro';
    case NPF_970_SET_OF_12 = 'Npf 970 (12 шт)';
    case NPF_750_SET_OF_1 = 'Npf 750 (1 шт)';
    case SMALL_RIG_V_MOUNT_99WH = 'Small Rig V mount 99wh';
    case AIR_2_BATTERIES = 'Аккумуляторы для Air 2';
    // Дроны
    case DJI_AIR_2 = 'Dji Air 2';
    // Карты памяти
    case SANDISK_64GB = 'Sandisk 64gb';
    case SANDISK_128GB_170MB_S = 'Sandisk 128gb 170mb/s';
    case MICRO_SANDISK_64_GB = 'Micro sandisk 64 gb';
    case SONY_256GB_UHS_2 = 'Sony 256gb UHS-2';
    case TOUGH_80GB_G_800_MBS = 'Tough 80Gb G 800 mbs';
    case SAMSUNG_EVO_PLUS_64GB = 'Samsung Evo plus 64gb';
    case SAMSUNG_EVO_PLUS_256GB = 'Samsung Evo plus 256gb';
    case MICRO_64GB_ADATA = 'Micro 64gb Adata';
    case SAMSUNG_T7_1TB = 'Samsung T7 1tb';
    // Клетки
    case UURIG_HAND_FOR_SONY_A7_3 = 'UUrig + hand for Sony a7 3';
    case UURIG_FOR_FUJIFILM_T4 = 'UUrig for Fujifilm T4';
    case SMALLRIG_FOR_A7C = 'Smallrig for A7c';
    case SMALLRIG_HAND_AND_HANDLE_A6600 = 'Smarig + рукоятка и ручка a6600';
    case TILTA_ADVANCED_FX6 = 'Tilta Advanced Fx6';
    case TILTA_ADVANCED_KIT_FX3 = 'Tilta advanced kit Fx3';
    // Мониторы
    case FEELWORLD_LUT_7_4K_HDMI = 'Feelworld LUT 7 4k HDMI';
    case LILIPUT_4K = 'Liliput 4K';
    case FEELWORLD_4K_ULTRA = 'Feelworld 4K ultra';
    // Разное
    case VIDEOSENDERS_HOLLYLAND_MARS_400S_PRO = 'Видео сендеры Hollyland Mars 400s pro';
    case VIDEO_SENDERS_HOLLYLAND_MARS_400S_PRO = 'Видео сендеры Hollyland mars 400s pro';
    case TELEPROMPTER_FEELWORLD_TP10 = 'Телесуфлер Feelworld Tp10';
    case REFLECTOR = 'Отражатель';
    case CHROMAKEY_200X150 = 'Хромакей 200x150';
    case SYNCHRONIZER_GODOX_X_PRO = 'Синхронизатор Godox X pro';
    case MONOPOD = 'Монопод';
    case COMPENDIUM_SMALLRIG = 'Компендиум SmallRig';
    case SMOKE_MACHINE_900W = 'Дым Машина 900ват';
    // Софтбоксы
    case SOFTBOX_LATERN_90 = 'Софтбокс Latern 90';
    case SOFTBOX_OCTADOME_120 = 'Софтбокс Octadome 120';
    case SOFTBOX_LIGHT_DOME_150 = 'Софтбокс Light Dome 150';
    case SOFTBOX_GODOX_60_60 = 'Софтбокс Godox 60/60';
    case FLASH_SOFTBOX = 'Софтбокс для вспышки';
    // Фильтры
    case ND_FREEWELL_67MM = 'Nd Freewell 67mm';
    case ND_77MM = 'Nd 77 mm';
    case ND_58MM = 'Nd 58mm';
    case ND_72MM = 'Nd 72 mm';
    case TIFFEN_MIST_FILTER_67MM = 'Tiffen mist filter 67mm';
    case POLARIZED_77MM = 'Polarized 77mm';
    // Штативы\стойки
    case LIGHT_STAND_GODOX_213B = 'Стойка Godox 213b';
    case LIGHT_STAND_GODOX_380 = 'Стойка Godox 380';
    case LIGHT_STAND_GODOX_SL = 'Стойка Godox sl';
    case REGULAR_LIGHT_STAND = 'Стойка обычная';
    case NO_NAME_LIGHT_STANDS = 'Стойки no name';
    case LARGE_NO_NAME_LIGHT_STAND = 'Стойка no name большая';
    case C_STAND_K2_MEKING = 'Стойка C stand k2 meking';
    case TRIPOD_COMAN = 'Штатив Coman';
    case ALUMINUM_TRIPOD = 'Штатив Алюминиевый';
    case BLACK_TRIPOD = 'Штатив черный';
    case CONTINENTAL_TRIPOD_DAMAGED = 'Штатив continental (поврежденный)';
    // Наборы
}