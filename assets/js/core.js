async function a1(url, data, callback, errors) {
    await $jq.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: async function (response) {
            await callback(response);
        },
        error: async function (xhr, status, error) {
            // 請求失敗時的處理
            await errors(error);
        }
    });
}