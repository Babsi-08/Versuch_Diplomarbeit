import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';

interface Entry {
    id: number;
    employee: string;
    kommen: string;
    gehen: string | null;
    dauer: string | null;
}

export default function Uebersicht({ entries }: { entries: Entry[] }) {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Übersicht
                </h2>
            }
        >
            <Head title="Übersicht" />

            <div className="py-12">
                <div className="mx-auto max-w-4xl space-y-6 sm:px-6 lg:px-8">
                    <div className="overflow-hidden rounded-2xl bg-white shadow-sm">
                        <table className="w-full text-left">
                            <thead>
                                <tr className="bg-pink-200 text-gray-800">
                                    <th className="px-6 py-4 font-semibold">Mitarbeiter</th>
                                    <th className="px-6 py-4 font-semibold">Kommen</th>
                                    <th className="px-6 py-4 font-semibold">Gehen</th>
                                    <th className="px-6 py-4 font-semibold">Dauer</th>
                                </tr>
                            </thead>
                            <tbody>
                                {entries.length === 0 && (
                                    <tr>
                                        <td
                                            colSpan={4}
                                            className="px-6 py-8 text-center text-gray-500"
                                        >
                                            Noch keine Einträge vorhanden.
                                        </td>
                                    </tr>
                                )}
                                {entries.map((entry) => (
                                    <tr
                                        key={entry.id}
                                        className="border-t-2 border-pink-50 hover:bg-pink-50/40"
                                    >
                                        <td className="px-6 py-4 font-semibold">
                                            {entry.employee}
                                        </td>
                                        <td className="px-6 py-4">{entry.kommen}</td>
                                        <td className="px-6 py-4">{entry.gehen ?? '—'}</td>
                                        <td className="px-6 py-4">
                                            {entry.dauer ?? (
                                                <span className="rounded-full bg-green-300 px-3 py-1 text-sm font-semibold text-gray-800">
                                                    läuft…
                                                </span>
                                            )}
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>

                    <Link
                        href={route('stempeln')}
                        className="block text-center text-lg font-medium text-pink-700 hover:text-pink-900"
                    >
                        ← Zurück zur Stempeluhr
                    </Link>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
