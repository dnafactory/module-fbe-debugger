<?php

namespace DNAFactory\FacebookBusinessExtensionDebugger\Api;

interface DebuggerConfigInterface
{
    /**
     * @return bool
     */
    public function isEnabled(): bool;

    /**
     * @return string
     */
    public function getDebugCode(): string;

    /**
     * @param string $event
     * @return bool
     */
    public function activeForEvent(string $event): bool;
}
