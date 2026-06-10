<div id="pw-box-{{ $inputId ?? 'password' }}" style="display:none; margin-top:6px; font-size:12px;">
    <ul id="pw-list-{{ $inputId ?? 'password' }}" style="list-style:none; padding:0; margin:0;"></ul>
</div>

<script>
(function(){
    var id   = '{{ $inputId ?? "password" }}';
    var inp  = document.getElementById(id);
    var lbl  = document.querySelector('label[for="' + id + '"]');
    if (!inp) return;

    var rules = [
        { key:'len', label: '{{ app()->getLocale() == "ar" ? "8 أحرف على الأقل" : "At least 8 characters" }}' },
        { key:'up',  label: '{{ app()->getLocale() == "ar" ? "حرف كبير (A-Z)" : "Uppercase letter (A-Z)" }}' },
        { key:'low', label: '{{ app()->getLocale() == "ar" ? "حرف صغير (a-z)" : "Lowercase letter (a-z)" }}' },
        { key:'num', label: '{{ app()->getLocale() == "ar" ? "رقم (0-9)" : "Number (0-9)" }}' },
        { key:'sym', label: '{{ app()->getLocale() == "ar" ? "رمز خاص (@#$!)" : "Symbol (@#$!)" }}' },
    ];

    inp.addEventListener('input', function(){
        var v    = this.value;
        var box  = document.getElementById('pw-box-' + id);
        var list = document.getElementById('pw-list-' + id);

        if (!v) {
            box.style.display = 'none';
            if (lbl) lbl.style.color = '';
            return;
        }

        var checks = {
            len: v.length >= 8,
            up:  /[A-Z]/.test(v),
            low: /[a-z]/.test(v),
            num: /[0-9]/.test(v),
            sym: /[@#$!%*?&]/.test(v),
        };

        var allValid = Object.values(checks).every(Boolean);

        // Label يصبح أخضر عند اكتمال الشروط
        if (lbl) lbl.style.color = allValid ? '#27ae60' : '';

        // إخفاء الصندوق إذا كل الشروط مكتملة
        if (allValid) {
            box.style.display = 'none';
            return;
        }

        box.style.display = 'block';
        list.innerHTML = '';

        // عرض الشروط الفاشلة فقط
        rules.forEach(function(r){
            if (!checks[r.key]) {
                var li = document.createElement('li');
                li.textContent = '✗ ' + r.label;
                li.style.color = '#e74c3c';
                li.style.marginBottom = '2px';
                list.appendChild(li);
            }
        });
    });
})();
</script>
