<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Келесі :attribute кілті керек.',
    'accepted_if' => 'Келесі :attribute :other :value болғанда қабылдануы керек.',
    'active_url' => ':attribute мәні жарамды URL болуы керек.',
    'after' => ':attribute мәні :date күнінен кейін болуы керек.',
    'after_or_equal' => ':attribute мәні :date күніне кейін немесе оған тең болуы керек.',
    'alpha' => ':attribute тек әріптерден тұруы керек.',
    'alpha_dash' => ':attribute тек әріптер, сандар, тире және астынғы таңбалардан тұруы керек.',
    'alpha_num' => ':attribute тек әріптер және сандардан тұруы керек.',
    'array' => ':attribute мәні әрекет болуы керек.',
    'ascii' => ':attribute тек бір байттық алфавиттік символдар мен белгілерден тұруы керек.',
    'before' => ':attribute мәні :date күнінен бұрын болуы керек.',
    'before_or_equal' => ':attribute мәні :date күнінен бұрын немесе оған тең болуы керек.',
    'between' => [
        'array' => ':attribute мәні :min және :max элементтер арасында болуы керек.',
        'file' => ':attribute мәні :min және :max килобайт арасында болуы керек.',
        'numeric' => ':attribute мәні :min және :max арасында болуы керек.',
        'string' => ':attribute мәні :min және :max таңбадан тұруы керек.',
    ],
    'boolean' => ':attribute мәні true немесе false болуы керек.',
    'can' => ':attribute мәні рұқсатсыз мәнді болуы керек.',
    'confirmed' => ':attribute растау мәнді сәйкес келмейді.',
    'current_password' => 'Құпия сөз дұрыс емес.',
    'date' => ':attribute мәні жарамды күн болуы керек.',
    'date_equals' => ':attribute мәні :date күнімен тең болуы керек.',
    'date_format' => ':attribute мәні :format пішімімен сәйкес келмейді.',
    'decimal' => ':attribute мәні :decimal ондықтан асқын болуы керек.',
    'declined' => ':attribute қабылданбады.',
    'declined_if' => ':attribute :other :value болғанда қабылданбады.',
    'different' => ':attribute және :other аралығында сәйкесіз болуы керек.',
    'digits' => ':attribute мәні :digits символдан тұруы керек.',
    'digits_between' => ':attribute мәні :min және :max символдар арасында болуы керек.',
    'dimensions' => ':attribute мәні жарамсыз сурет өлшемдеріне ие.',
    'distinct' => ':attribute мәні қайталанатын.',
    'doesnt_end_with' => ':attribute мәні келесі келесі қоңыраулардан бірімен аяқталмауы керек: :values.',
    'doesnt_start_with' => ':attribute мәні келесі келесі қоңыраулардан бірімен басталмауы керек: :values.',
    'email' => ':attribute мәні жарамды электрондық пошта мекенжайы болуы керек.',
    'ends_with' => ':attribute мәні келесі келесі қоңыраулардан бірімен аяқталуы керек: :values.',
    'enum' => 'Таңдалған :attribute жарамсыз.',
    'exists' => 'Таңдалған :attribute жарамсыз.',
    'extensions' => ':attribute мәні келесі келесілетін кіріс өтініштерінен бірі болуы керек: :values.',
    'file' => ':attribute файл болуы керек.',
    'filled' => ':attribute мәні болуы керек.',
    'gt' => [
        'array' => ':attribute элементтер саны :value-дан көп болуы керек.',
        'file' => ':attribute мәні :value килобайттан артық болуы керек.',
        'numeric' => ':attribute мәні :value-дан үлкен болуы керек.',
        'string' => ':attribute мәні :value таңбадан үлкен болуы керек.',
    ],
    'gte' => [
        'array' => ':attribute элементтер саны :value-дан көп немесе оған тең болуы керек.',
        'file' => ':attribute мәні :value килобайт немесе оған тең болуы керек.',
        'numeric' => ':attribute мәні :value-дан үлкен немесе оған тең болуы керек.',
        'string' => ':attribute мәні :value таңбадан үлкен немесе оған тең болуы керек.',
    ],
    'hex_color' => ':attribute мәні жарамды он шифрлы реттік түс болуы керек.',
    'image' => ':attribute мәні сурет болуы керек.',
    'in' => 'Таңдалған :attribute жарамсыз.',
    'in_array' => ':attribute мәні :other ішінде болуы керек.',
    'integer' => ':attribute мәні бүтін сан болуы керек.',
    'ip' => ':attribute мәні жарамды IP мекенжайы болуы керек.',
    'ipv4' => ':attribute мәні жарамды IPv4 мекенжайы болуы керек.',
    'ipv6' => ':attribute мәні жарамды IPv6 мекенжайы болуы керек.',
    'json' => ':attribute мәні жарамды JSON жолы болуы керек.',
    'lowercase' => ':attribute мәні кіші әріптерден тұруы керек.',
    'lt' => [
        'array' => ':attribute элементтер саны :value-дан аз болуы керек.',
        'file' => ':attribute мәні :value килобайттан аз болуы керек.',
        'numeric' => ':attribute мәні :value-дан кіші болуы керек.',
        'string' => ':attribute мәні :value таңбадан аз болуы керек.',
    ],
    'lte' => [
        'array' => ':attribute элементтер саны :value-дан кем немесе оған тең болуы керек.',
        'file' => ':attribute мәні :value килобайт немесе оған тең болуы керек.',
        'numeric' => ':attribute мәні :value-дан кіші немесе оған тең болуы керек.',
        'string' => ':attribute мәні :value таңбадан кіші немесе оған тең болуы керек.',
    ],
    'mac_address' => ':attribute мәні жарамды MAC мекенжайы болуы керек.',
    'max' => [
        'array' => ':attribute элементтер саны :max-дан аспауы керек.',
        'file' => ':attribute мәні :max килобайттан аспауы керек.',
        'numeric' => ':attribute мәні :max-дан үлкен болуы керек.',
        'string' => ':attribute мәні :max таңбадан үлкен болуы керек.',
    ],
    'max_digits' => ':attribute мәні :max символдан аспауы керек.',
    'mimes' => ':attribute мәні келесі келесілетін файл түрлерінен бірі болуы керек: :values.',
    'mimetypes' => ':attribute мәні келесі келесілетін файл түрлерінен бірі болуы керек: :values.',
    'min' => [
        'array' => ':attribute элементтер саны кемесе :min болуы керек.',
        'file' => ':attribute мәні кемесе :min килобайт болуы керек.',
        'numeric' => ':attribute мәні кемесе :min болуы керек.',
        'string' => ':attribute мәні кемесе :min таңбадан болуы керек.',
    ],
    'min_digits' => ':attribute мәні кемесе :min символдан болуы керек.',
    'missing' => ':attribute мәні толтырылуы керек.',
    'missing_if' => ':attribute :other :value болғанда жоқ келуі керек.',
    'missing_unless' => ':attribute :other :value-дан басқа болмаған кезде жоқ келуі керек.',
    'missing_with' => ':values мәні келгенде :attribute мәні жоқ болуы керек.',
    'missing_with_all' => ':values мәні келгенде :attribute мәні жоқ болуы керек.',
    'multiple_of' => ':attribute мәні :value-нің бір көбі болуы керек.',
    'not_in' => 'Таңдалған :attribute жарамсыз.',
    'not_regex' => ':attribute пішімі жарамсыз.',
    'numeric' => ':attribute мәні сан болуы керек.',
    'password' => [
        'letters' => ':attribute мәні ең кем де бір әріптен тұруы керек.',
        'mixed' => ':attribute мәні кем де бір көп әріптер мен кіші әріптерден тұруы керек.',
        'numbers' => ':attribute мәні ең кем де бір сандан тұруы керек.',
        'symbols' => ':attribute мәні ең кем де бір белгілерден тұруы керек.',
        'uncompromised' => 'Берілген :attribute мәні деректерден шығады. Басқа :attribute таңдаңыз.',
    ],
    'present' => ':attribute мәні болуы керек.',
    'present_if' => ':other :value болғанда :attribute мәні болуы керек.',
    'present_unless' => ':other :value-дан басқа болмаған кезде :attribute мәні болуы керек.',
    'present_with' => ':values келгенде :attribute мәні болуы керек.',
    'present_with_all' => ':values келгенде :attribute мәні болуы керек.',
    'prohibited' => ':attribute мәні тыйым салынған.',
    'prohibited_if' => ':other :value болғанда :attribute мәні тыйым салынған.',
    'prohibited_unless' => ':other :values ішінде болмаған кезде :attribute мәні тыйым салынған.',
    'prohibits' => ':attribute мәні :other болуын тыйым салады.',
    'regex' => ':attribute пішімі жарамсыз.',
    'required' => ':attribute мәні міндетті түрде толтырылуы керек.',
    'required_array_keys' => ':attribute мәнінде :values кілттері мәнді болуы керек.',
    'required_if' => ':other :value болғанда :attribute мәні міндетті түрде толтырылуы керек.',
    'required_if_accepted' => ':other қабылданған болғанда :attribute мәні міндетті түрде толтырылуы керек.',
    'required_unless' => ':other :values ішінде болмаған кезде :attribute мәні міндетті түрде толтырылуы керек.',
    'required_with' => ':values келгенде :attribute мәні міндетті түрде толтырылуы керек.',
    'required_with_all' => ':values келгенде :attribute мәні міндетті түрде толтырылуы керек.',
    'required_without' => ':values келмегенде :attribute мәні міндетті түрде толтырылуы керек.',
    'required_without_all' => ':values келмеген кезде :attribute мәні міндетті түрде толтырылуы керек.',
    'same' => ':attribute мәні :other мәнімен сәйкес келуі керек.',
    'size' => [
        'array' => ':attribute элементтер саны :size болуы керек.',
        'file' => ':attribute мәні :size килобайт болуы керек.',
        'numeric' => ':attribute мәні :size болуы керек.',
        'string' => ':attribute мәні :size таңбадан болуы керек.',
    ],
    'starts_with' => ':attribute мәні келесі келесілетіндей басылуы керек: :values.',
    'string' => ':attribute мәні тізім болуы керек.',
    'timezone' => ':attribute мәні жарамды уақыт белдеуі керек.',
    'unique' => ':attribute бұлды тіркеу үшін қол жетімді.',
    'uploaded' => ':attribute жүктелмеді.',
    'uppercase' => ':attribute мәні көп әріптерден тұруы керек.',
    'url' => ':attribute мәні жарамды URL болуы керек.',
    'ulid' => ':attribute мәні жарамды ULID болуы керек.',
    'uuid' => ':attribute мәні жарамды UUID болуы керек.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],
];
