import mitt, { Emitter } from 'mitt';
import type { AppEvents } from "@/types";

export default mitt<AppEvents>()
