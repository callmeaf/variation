<?php

namespace Callmeaf\Variation\Utilities\V1\VariationType\Api;

use Callmeaf\Base\Utilities\V1\FormRequestAuthorizer;
use Callmeaf\Permission\Enums\PermissionName;

class VariationTypeFormRequestAuthorizer extends FormRequestAuthorizer
{
    public function index(): bool
    {
        return true;
    }

    public function create(): bool
    {
        return userCan(PermissionName::VARIATION_STORE);
    }

    public function store(): bool
    {
        return userCan(PermissionName::VARIATION_STORE);
    }

    public function show(): bool
    {
        return true;
    }

    public function edit(): bool
    {
        return userCan(PermissionName::VARIATION_UPDATE);
    }

    public function update(): bool
    {
        return userCan(PermissionName::VARIATION_UPDATE);
    }

    public function statusUpdate(): bool
    {
        return userCan(PermissionName::VARIATION_UPDATE);
    }

    public function destroy(): bool
    {
        return userCan(PermissionName::VARIATION_DESTROY);
    }

}
